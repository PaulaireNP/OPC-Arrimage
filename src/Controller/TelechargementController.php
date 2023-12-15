<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TelechargementController extends AbstractController
{
    #[Route('/telechargement', name: 'app_telechargement')]
    public function index(): Response
    {
        return $this->render('telechargement/index.html.twig', [
            'controller_name' => 'TelechargementController',
        ]);
    }
}
