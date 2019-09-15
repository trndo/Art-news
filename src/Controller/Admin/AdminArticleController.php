<?php


namespace App\Controller\Admin;

use App\Service\ContentHandler\ArticleHandler\DisplayArticleInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController
{
    /**
     * @Route("/artadmin/articles", name="showAllArticles")
     * @param DisplayArticleInterface $displayArticle
     * @return Response
     */
    public function showAllArticles(DisplayArticleInterface $displayArticle): Response
    {
        $articles = $displayArticle->showArticles();

        return $this->render('admin/article_controller/showAllArticles.html.twig', [
            'articles' => $articles
        ]);
    }
}