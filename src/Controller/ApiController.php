<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ArticleServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name:'api.')]
class ApiController extends AbstractController
{
    private const DEFAULT_COUNT =30;

    #[Route('/recent-articles', methods:['GET'])]
    public function getArticles(Request $request, ArticleServiceInterface $articleService, int $count = self::DEFAULT_COUNT): JsonResponse
    {
        if (!($request->query->has('count') && ctype_digit($request->query->get('count')))) {
            $count = self::DEFAULT_COUNT;
        }

        $data = [];

        /**@var App\Enityt\Article $article */

        foreach ($articleService->getRecentArticles($count)->getQuery()->getResult() as $article){
            $data[] = [
                'id' => $article->getId(),
                'title'=> $article->getTitle(),
                'body' => $article->getBody(),
                'created_at' => $article->getCreatedAt()->format('d.m.Y H:i:s'),
                'author' => [
                    'id'=> $article->getAuthor()->getId(),
                    'name'=> $article->getAuthor()->__toString(),
                ],
            ];
        }

        return new JsonResponse($data);


    }


}