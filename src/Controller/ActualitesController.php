<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ActualitesController extends AbstractController
{
    #[Route('/actualites', name: 'app_actualites')]
    public function index(ArticleRepository $articleRepository, Request $request): Response
    {
        $query = $articleRepository->createQueryBuilder('a')
            ->where('a.visible = :visible')
            ->setParameter('visible', true)
            ->orderBy('a.creationDate', 'DESC')
            ->getQuery();

        $paginator = new Paginator($query);
        $currentPage = $request->query->getInt('page', 1);
        $perPage = 8;

        $articles = $paginator
            ->getQuery()
            ->setFirstResult(($currentPage - 1) * $perPage)
            ->setMaxResults($perPage)
            ->getResult();

        $totalItems = count($paginator);

        return $this->render('actualites/index.html.twig', [
            'title_one' => 'Actualités',
            'title_two' => '',
            'articles' => $articles,
            'totalItems' => $totalItems,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
        ]);
    }
}

