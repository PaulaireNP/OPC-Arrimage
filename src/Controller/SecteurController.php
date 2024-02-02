<?php

namespace App\Controller;

use App\Entity\Secteur;
use App\Form\SecteurType;
use App\Repository\JeuneRepository;
use App\Repository\SecteurRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/secteur')]
class SecteurController extends AbstractController
{
    #[Route('/', name: 'app_secteur_index', methods: ['GET'])]
    public function index(SecteurRepository $secteurRepository): Response
    {
        return $this->render('secteur/index.html.twig', [
            'secteurs' => $secteurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_secteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $secteur = new Secteur();
        $form = $this->createForm(SecteurType::class, $secteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($secteur);
            $entityManager->flush();

            return $this->redirectToRoute('app_secteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('secteur/new.html.twig', [
            'secteur' => $secteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_secteur_show', methods: ['GET'])]
    public function show(Secteur $secteur, JeuneRepository $jeuneRepository, UserRepository $userRepository): Response
    {
        $jeunes = $jeuneRepository->findBySecteur($secteur);
        $users = $userRepository->findBySecteur($secteur);
        return $this->render('secteur/show.html.twig', [
            'secteur' => $secteur,
            'jeunes' => $jeunes,
            'users' => $users,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_secteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Secteur $secteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SecteurType::class, $secteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_secteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('secteur/edit.html.twig', [
            'secteur' => $secteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_secteur_delete', methods: ['POST'])]
    public function delete(Request $request, Secteur $secteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$secteur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($secteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_secteur_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route("/users/{id}", name: 'secteur_users', methods: ['GET'])]
    public function getUsersBySecteur(Secteur $secteur, UserRepository $userRepository): JsonResponse
    {
        $users = $userRepository->findBySecteur($secteur);

        $usersArray = []; // Convertir les objets utilisateur en tableau ou en objet simplifié

        foreach ($users as $user) {
            $usersArray[] = [
                'id' => $user->getId(),
                'name' => $user->getLastname(),
            ];
        }

        return new JsonResponse($usersArray);
    }
}
