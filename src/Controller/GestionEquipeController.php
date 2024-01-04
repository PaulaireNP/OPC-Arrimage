<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionEquipeController extends AbstractController
{
    #[Route('/gestion/equipe', name: 'app_gestion_equipe')]
    public function index(): Response
    {
        return $this->render('gestion_equipe/index.html.twig', [
            'controller_name' => 'GestionEquipeController',
        ]);
    }
}
