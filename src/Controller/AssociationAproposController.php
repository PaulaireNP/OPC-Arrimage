<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssociationAproposController extends AbstractController
{
    #[Route('/association/a-propos', name: 'app_association_apropos')]
    public function index(): Response
    {
        return $this->render('association_apropos/index.html.twig', [
            'controller_name' => 'AssociationAproposController',
        ]);
    }
}
