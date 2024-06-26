<?php

namespace App\Controller;

use App\Entity\Documents;
use App\Form\DocumentsType;
use App\Repository\DocumentsRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/documents')]
class DocumentsController extends AbstractController
{
    #[Route('/', name: 'app_documents_index', methods: ['GET'])]
    public function index(DocumentsRepository $documentsRepository): Response
    {
        return $this->render('documents/index.html.twig', [
            'documents' => $documentsRepository->findAll(),
        ]);
    }

    #[Route('/new{category}', name: 'app_documents_new', methods: ['GET', 'POST'],)]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader, $category = null): Response
    {
        $document = new Documents();
        $document->setCategorie($category);
        $form = $this->createForm(DocumentsType::class, $document);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form -> get('file') -> getData();
            if($file){
                $document->setFile($fileUploader->uploadDocument($file));
            }

            $entityManager->persist($document);
            $entityManager->flush();

            return $this->redirectToRoute('app_documents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('documents/new.html.twig', [
            'document' => $document,
            'form' => $form,
            'category' => $category
        ]);
    }

    #[Route('/{id}', name: 'app_documents_show', methods: ['GET'])]
    public function show(Documents $document): Response
    {
        return $this->render('documents/show.html.twig', [
            'document' => $document,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_documents_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Documents $document, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(DocumentsType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form -> get('file') -> getData();
            if($file){
                $document->setFile($fileUploader->uploadDocument($file));
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_documents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('documents/edit.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_documents_delete', methods: ['POST'])]
    public function delete(Request $request, Documents $document, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $entityManager->remove($document);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_documents_index', [], Response::HTTP_SEE_OTHER);
    }
}
