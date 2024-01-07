<?php

namespace App\Service;

interface ArticleServiceInterface
{
    public function getRecentArticles(int $count, ?string $search = null): \Doctrine\ORM\QueryBuilder;

    //получение 1-ой статьи по id
    public function getSingleArticleByIds(int $id);
}