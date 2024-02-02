<?php

namespace App\Controller;

use App\Entity\Secteur;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\JeuneRepository;
use App\Repository\UserRepository;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setCreationDate(creationDate: new DateTime('now', new DateTimeZone('Europe/Paris')));
            $user->setLastModification(lastModification: new DateTime('now', new DateTimeZone('Europe/Paris')));
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'userForm' => $form->createView(),
            'date' => $date,
        ]);
    }
    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user, JeuneRepository $jeuneRepository, Request $request): Response
    {
        $jeunes = $jeuneRepository->findByReferentEduc($user);
        $coJeunes = $jeuneRepository->findByCoreferentEduc($user);
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'jeunes' => $jeunes,
            'coJeunes' => $coJeunes,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if (isset ($_POST["user-email"], $_POST["user-lastname"], $_POST["user-firstname"], $_POST["user-mobile"], $_POST["user-secteur"])) {
            if (isset($_POST["motDePasse1"], $_POST["motDePasse2"])) {
                if ($_POST["motDePasse1"] == $_POST["motDePasse2"]) {
                    $user->setPassword($this->passwordHasher->hashPassword($user, $_POST["motDePasse1"]));
                }
            }
            $user->setEmail($_POST["user-email"]);
            $user->setLastname($_POST["user-lastname"]);
            $user->setFirstname($_POST["user-firstname"]);
            $user->setMobile($_POST["user-mobile"]);
            $user->setLastModification(new DateTime('now', new DateTimeZone('Europe/Paris')));
            $secteurId = $_POST["user-secteur"];
            $secteur = $entityManager->getRepository(Secteur::class)->find($secteurId);
            if ($secteur) {
                $user->setSecteur($secteur);
            } else {
                #todo gestion d'erreurs + log
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }
        $secteurs = $entityManager->getRepository(Secteur::class)->findAll();

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'secteurs' => $secteurs,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}