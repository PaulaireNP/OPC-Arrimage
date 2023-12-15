<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssociationHistoireController extends AbstractController
{
    #[Route('/association/histoire', name: 'app_association_histoire')]
    public function index(): Response
    {
        return $this->render('association_histoire/index.html.twig', [
            'controller_name' => 'AssociationHistoireController',
        ]);
    }
}
