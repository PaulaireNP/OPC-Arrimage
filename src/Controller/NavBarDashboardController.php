<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavBarDashboardController extends AbstractController
{
    #[Route('/nav/bar/dashboardAdmin', name: 'app_nav_bar_dashboard')]
    public function index(): Response
    {
        return $this->render('navbarDashboardAdmin.sass.html.twig', [
            'controller_name' => 'NavBarDashboardController',
        ]);
    }
}
