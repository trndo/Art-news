<?php


namespace App\Controller\Api;

use App\Service\ContentHandler\ArticleHandler\DisplayArticleInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiArticleController extends AbstractController
{
    /**
     * @Route("/api/articles", methods={"GET"})
     *
     * @param Request $request
     * @param DisplayArticleInterface $displayArticle
     * @return JsonResponse
     */
    public function getArticles(Request $request, DisplayArticleInterface $displayArticle): JsonResponse
    {
        $locale = $request->query->get('locale');
        $articles = $displayArticle->showArticles($locale);

        return new JsonResponse([
            'articles' => $articles
        ],200);
    }

    /**
     * @Route("/api/articles/{slug}", methods={"GET"})
     *
     * @param Request $request
     * @param DisplayArticleInterface $displayArticle
     * @return JsonResponse
     */
    public function showArticle(Request $request, DisplayArticleInterface $displayArticle): JsonResponse
    {
        $slug = $request->query->get('slug');
        $article = $displayArticle->showArticleBy($slug);

        return new JsonResponse([
            'article' => $article
        ],200);
    }
}