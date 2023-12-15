<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NosServicesActionsCollectivesController extends AbstractController
{
    #[Route('/nos-services/actions-collectives', name: 'app_nos_services_actions_collectives')]
    public function index(): Response
    {
        return $this->render('nos_services_actions_collectives/index.html.twig', [
            'controller_name' => 'NosServicesActionsCollectivesController',
        ]);
    }
}
