<?php

namespace App\Controller;

use App\Entity\FicheSuivi;
use App\Form\FicheSuiviType;
use App\Repository\FicheSuiviRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fiche/suivi')]
class FicheSuiviController extends AbstractController
{
    #[Route('/', name: 'app_fiche_suivi_index}', methods: ['GET'])]
    public function index(FicheSuiviRepository $ficheSuiviRepository): Response
    {

        return $this->render('fiche_suivi/index.html.twig', [
            'fiche_suivis' => $ficheSuiviRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fiche_suivi_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ficheSuivi = new FicheSuivi();
        $form = $this->createForm(FicheSuiviType::class, $ficheSuivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ficheSuivi);
            $entityManager->flush();

            return $this->redirectToRoute('app_fiche_suivi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fiche_suivi/new.html.twig', [
            'fiche_suivi' => $ficheSuivi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fiche_suivi_show', methods: ['GET'])]
    public function show(FicheSuivi $ficheSuivi): Response
    {
        return $this->render('fiche_suivi/show.html.twig', [
            'fiche_suivi' => $ficheSuivi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fiche_suivi_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FicheSuivi $ficheSuivi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FicheSuiviType::class, $ficheSuivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fiche_suivi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fiche_suivi/edit.html.twig', [
            'fiche_suivi' => $ficheSuivi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fiche_suivi_delete', methods: ['POST'])]
    public function delete(Request $request, FicheSuivi $ficheSuivi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheSuivi->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ficheSuivi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fiche_suivi_index', [], Response::HTTP_SEE_OTHER);
    }
}
