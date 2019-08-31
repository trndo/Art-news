<?php


namespace App\Controller\Admin;


use App\Form\ContentType;
use App\Model\ContentModel;
use App\Service\ContentHandler\ArticleHandler\DisplayArticleInterface;
use App\Service\ContentHandler\ResumeHandler\ArticleHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        return $this->render('article_controller/showAllArticles.html.twig',[
            'articles' => $articles
        ]);
    }
}