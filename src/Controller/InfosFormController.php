<?php

namespace App\Controller;

use App\Entity\InfosForm;
use App\Form\InfosFormType;
use App\Repository\InfosFormRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/infos/form')]
class InfosFormController extends AbstractController
{
    #[Route('/', name: 'app_infos_form_index', methods: ['GET'])]
    public function index(InfosFormRepository $infosFormRepository): Response
    {
        return $this->render('infos_form/index.html.twig', [
            'infos_forms' => $infosFormRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_infos_form_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $infosForm = new InfosForm();
        $form = $this->createForm(InfosFormType::class, $infosForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($infosForm);
            $entityManager->flush();

            return $this->redirectToRoute('app_infos_form_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('infos_form/new.html.twig', [
            'infos_form' => $infosForm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_infos_form_show', methods: ['GET'])]
    public function show(InfosForm $infosForm): Response
    {
        return $this->render('infos_form/show.html.twig', [
            'infos_form' => $infosForm,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_infos_form_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InfosForm $infosForm, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InfosFormType::class, $infosForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_infos_form_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('infos_form/edit.html.twig', [
            'infos_form' => $infosForm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_infos_form_delete', methods: ['POST'])]
    public function delete(Request $request, InfosForm $infosForm, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infosForm->getId(), $request->request->get('_token'))) {
            $entityManager->remove($infosForm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_infos_form_index', [], Response::HTTP_SEE_OTHER);
    }
}
