<?php


namespace App\Controller\Admin;


use App\Entity\Article;
use App\Entity\ArticleTranslation;
use App\Form\ContentType;
use App\Mapper\ArticleMapper;
use App\Model\ContentModel;
use App\Service\ContentHandler\ResumeHandler\ArticleHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleHandlerController extends AbstractController
{
    /**
     * @Route("/artadmin/articles/create", "createArticle")
     * @param Request $request
     * @param ArticleHandlerInterface $articleHandler
     * @return Response
     */
    public function createArticle(Request $request, ArticleHandlerInterface $articleHandler): Response
    {
        $model = new ContentModel();
        $form = $this->createForm(ContentType::class,$model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $articleHandler->createArticle($data);

            return $this->redirectToRoute('');
        }

        return $this->render('article_controller/createArticle.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/artadmin/articles/{id}/edit", name="updateArticle")
     * @param Request $request
     * @param ArticleTranslation $articleTranslation
     * @param ArticleHandlerInterface $articleHandler
     * @return Response
     */
    public function updateArticle(Request $request, ArticleTranslation $articleTranslation, ArticleHandlerInterface $articleHandler): Response
    {
        $model = ArticleMapper::entityToModel($articleTranslation);
        $form = $this->createForm(ContentType::class,$model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $articleHandler->updateArticle($data, $articleTranslation);

            return $this->redirectToRoute('');
        }

        return $this->render('article_controller/updateArticle.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/artadmin/articles/{id}/deleteTranslation", name="deleteArticleTranslation")
     * @param ArticleTranslation $articleTranslation
     * @param ArticleHandlerInterface $articleHandler
     * @return Response
     */
    public function deleteArticleTranslation(ArticleTranslation $articleTranslation, ArticleHandlerInterface $articleHandler): Response
    {
        $articleHandler->deleteTranslation($articleTranslation);

        return  $this->redirectToRoute('');
    }

    /**
     * @Route("/artadmin/articles/{id}/delete", name="deleteArticle")
     * @param Article $article
     * @param ArticleHandlerInterface $articleHandler
     * @return Response
     */
    public function deleteArticle(Article $article, ArticleHandlerInterface $articleHandler): Response
    {
        $articleHandler->deleteArticle($article);

        return  $this->redirectToRoute('');
    }


}