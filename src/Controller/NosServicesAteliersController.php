<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NosServicesAteliersController extends AbstractController
{
    #[Route('/nos-services-ateliers', name: 'app_nos_services_ateliers')]
    public function index(): Response
    {
        return $this->render('nos_services_ateliers/index.html.twig', [
            'title_one' => 'Ateliers',
            'title_two' => '',
        ]);
    }
}
