<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NosServicesAccompagnementSocialController extends AbstractController
{
    #[Route('/nos-services/accompagnement-social', name: 'app_nos_services_accompagnement_social')]
    public function index(): Response
    {
        return $this->render('nos_services_accompagnement_social/index.html.twig', [
            'title_one' => 'Accompagnement',
            'title_two' => 'social',
        ]);
    }
}
