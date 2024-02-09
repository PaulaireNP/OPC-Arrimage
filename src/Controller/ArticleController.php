<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Service\FileUploader;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/article')]
class ArticleController extends AbstractController
{

    #[Route('/', name: 'app_article_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig');
    }

    #[Route('/data', name: 'app_article_data',)]
    public function jsonData(ArticleRepository $articleRepository): JsonResponse
    {
        $articles = $articleRepository->findAll();

        $data = [];
        foreach ($articles as $article) {
            $data[] = [
                'id' => $article->getId(),
                'title' => $article->getTitle(),
                'description' => $article->getDescription(),
                'image' => $article->getImage(),
                'creationDate' => $article->getCreationDate(),
                'updateDate' => $article->getUpdateDate()->format('Y-m-d H:i:s'),
                'author' => $article->getAuthor(),
                'visible' => $article->isVisible(),
            ];
        }

        return $this->json($data);
    }

    #[Route('/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form -> get('image') -> getData();

            if($image){
                $article->setImage($fileUploader->uploadArticles($image));
            }

            $illustrations = $form->get('illustrations')->getData();
            dd($illustrations);
            $newIllustrations = [];
            foreach ($illustrations as $illustration) {
                $newIllustrations[] = $fileUploader->uploadIllustrations($illustration);
            }
            dd($newIllustrations);

            $article->setIllustrations($newIllustrations);
            $article -> setCreationDate(new DateTime('now', new DateTimeZone('Europe/Paris')));
            $article -> setUpdateDate(new DateTime('now', new DateTimeZone('Europe/Paris')));
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_article_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form -> get('image') -> getData();
            if($image){
                $article->setImage($fileUploader->uploadArticles($image));
            }
            $article -> setUpdateDate(new DateTime('now', new DateTimeZone('Europe/Paris')));
            $entityManager->flush();

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_article_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
    }
}
