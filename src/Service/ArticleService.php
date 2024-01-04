<?php

namespace App\Service;

use App\Repository\ArticleRepository;

class ArticleService
{
    public function __construct(private readonly ArticleRepository $articleRepository)
    {

    }


    public function getRecentArticles(int $count)
    {
        // место для дополнительного функционала перед отправкой (матем. модель, кеш...)
        return $this->articleRepository->getRecentArticles($count);
    }
}