<?php


namespace App\Controller\Api;

use App\Service\ContentHandler\ArticleHandler\DisplayArticleInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiArticleController extends AbstractController
{
    /**
     * @Route("/api/articles", methods={"GET"})
     *
     * @param DisplayArticleInterface $displayArticle
     * @return JsonResponse
     */
    public function getArticles(DisplayArticleInterface $displayArticle): JsonResponse
    {
        $articles = $displayArticle->showArticles();

        return new JsonResponse([
            'articles' => $articles
        ],200);
    }

    /**
     * @Route("/api/articles/{slug}", methods={"GET"})
     *
     * @param DisplayArticleInterface $displayArticle
     * @return JsonResponse
     */
    public function showArticle(DisplayArticleInterface $displayArticle): JsonResponse
    {
        $articles = $displayArticle->showArticles();

        return new JsonResponse([
            'articles' => $articles
        ]);
    }
}