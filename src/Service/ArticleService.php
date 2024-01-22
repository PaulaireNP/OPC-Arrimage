<?php

// src/Service/ArticleService.php

namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticleService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Récupère un article par son ID
     *
     * @param int $id
     * @return Article|null
     */
    public function getArticleById($id)
    {
        return $this->entityManager->getRepository(Article::class)->find($id);
    }
}

