<?php

namespace App\Controller;

use App\Entity\Jeune;
use App\Form\JeuneType;
use App\Repository\JeuneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/jeune')]
class JeuneController extends AbstractController
{
    #[Route('/', name: 'app_jeune_index', methods: ['GET'])]
    public function index(JeuneRepository $jeuneRepository): Response
    {
        return $this->render('jeune/index.html.twig', [
            'jeunes' => $jeuneRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_jeune_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jeune = new Jeune();
        $form = $this->createForm(JeuneType::class, $jeune);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jeune);
            $entityManager->flush();

            return $this->redirectToRoute('app_jeune_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jeune/new.html.twig', [
            'jeune' => $jeune,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jeune_show', methods: ['GET'])]
    public function show(Jeune $jeune): Response
    {
        return $this->render('jeune/show.html.twig', [
            'jeune' => $jeune,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_jeune_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Jeune $jeune, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JeuneType::class, $jeune);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_jeune_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jeune/edit.html.twig', [
            'jeune' => $jeune,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jeune_delete', methods: ['POST'])]
    public function delete(Request $request, Jeune $jeune, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jeune->getId(), $request->request->get('_token'))) {
            $entityManager->remove($jeune);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_jeune_index', [], Response::HTTP_SEE_OTHER);
    }
}