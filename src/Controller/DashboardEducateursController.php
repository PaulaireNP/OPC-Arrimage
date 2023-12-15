<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardEducateursController extends AbstractController
{
    #[Route('/dashboard/educateurs', name: 'app_dashboard_educateurs')]
    public function index(): Response
    {
        return $this->render('dashboard_educateurs/index.html.twig', [
            'controller_name' => 'DashboardEducateursController',
        ]);
    }
}
