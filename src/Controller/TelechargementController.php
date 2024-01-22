<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DocumentsRepository;

class TelechargementController extends AbstractController
{
    #[Route('/telechargement', name: 'app_telechargement')]
    public function index(DocumentsRepository $documentsRepository, Request $request): Response
    {
        $docAssoc = $documentsRepository->findBy(['visible' => true, 'categorie' => 'Association']);
        $totalAssoc = count($docAssoc);
        $docRappo = $documentsRepository->findBy(['visible' => true, 'categorie' => 'Rapports d activites']);
        $totalRappo = count($docRappo);
        $docPreve = $documentsRepository->findBy(['visible' => true, 'categorie' => 'Prevention specialise']);
        $totalPreve = count($docPreve);

        return $this->render('telechargement/index.html.twig', [
            'docAssoc' => $docAssoc,
            'totalAssoc' => $totalAssoc,
            'docRappo' => $docRappo,
            'totalRappo' => $totalRappo,
            'docPreve' => $docPreve,
            'totalPreve' => $totalPreve
        ]);
    }
}

