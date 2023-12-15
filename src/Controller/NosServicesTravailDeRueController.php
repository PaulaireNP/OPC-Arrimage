<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NosServicesTravailDeRueController extends AbstractController
{
    #[Route('/nos-services/travail-de-rue', name: 'app_nos_services_travail_de_rue')]
    public function index(): Response
    {
        return $this->render('nos_services_travail_de_rue/index.html.twig', [
            'controller_name' => 'NosServicesTravailDeRueController',
        ]);
    }
}
