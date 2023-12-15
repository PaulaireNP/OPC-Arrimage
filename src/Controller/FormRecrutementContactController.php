<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormRecrutementContactController extends AbstractController
{
    #[Route('/form/recrutement/contact', name: 'app_form_recrutement_contact')]
    public function index(): Response
    {
        return $this->render('form_recrutement_contact/index.html.twig', [
            'controller_name' => 'FormRecrutementContactController',
        ]);
    }
}
