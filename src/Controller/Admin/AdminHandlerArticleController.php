<?php


namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\ArticleTranslation;
use App\Form\ContentType;
use App\Form\PhotoType;
use App\Mapper\ArticleMapper;
use App\Model\ContentModel;
use App\Service\ContentHandler\ArticleHandler\ArticleHandlerInterface;
use App\Service\ContentHandler\ArticleHandler\ArticleTranslationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminHandlerArticleController extends AbstractController
{
    /**
     * @Route("/artadmin/articles/create", name="createArticle")
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

            return $this->redirectToRoute('showAllArticles');
        }

        return $this->render('admin/article_controller/createArticle.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/artadmin/articles/{id}/edit", name="updateArticle")
     * @param Request $request
     * @param Article $article
     * @param ArticleHandlerInterface $articleHandler
     * @return Response
     */
    public function updateArticle(Request $request, Article $article, ArticleHandlerInterface $articleHandler): Response
    {
        $form = $this->createForm(PhotoType::class,$article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Article $data*/
            $data = $form->getData();
            $photo = $request->files->get('photo')['photo'];
            $articleHandler->updatePhoto($data, $photo);

            return $this->redirectToRoute('showAllArticles');
        }

        return $this->render('admin/article_controller/updateArticle.html.twig',[
            'form' => $form->createView(),
            'article' => $article
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

        return  $this->redirectToRoute('showAllArticles');
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

        return  $this->redirectToRoute('showAllArticles');
    }

    /**
     * @Route("/artadmin/articles/{id}/translation/create", name="createArticleTranslation")
     * @param Request $request
     * @param Article $article
     * @param ArticleTranslationInterface $articleTranslation
     * @return Response
     */
    public function createArticleTranslation(Request $request, Article $article, ArticleTranslationInterface $articleTranslation): Response
    {
        $model = new ContentModel();
        $options['translation'] = true;
        $form = $this->createForm(ContentType::class, $model, $options);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $articleTranslation->createArticleTranslation($article, $data);

            return $this->redirectToRoute('showAllArticles');
        }

        return $this->render('admin/article_controller/addArticleTranslation.html.twig',[
            'form' => $form->createView(),
            'article' => $article
        ]);
    }

    /**
     * @Route("/artadmin/articles/{id}/translation/{translation_id}/show", name="showArticleTranslation")
     * @ParamConverter("articleTranslation", options={"id" = "translation_id"})
     * @param Article $article
     * @param ArticleTranslation $articleTranslation
     * @param ArticleTranslationInterface $translation
     * @return Response
     */
    public function showArticleTranslation(Article $article, ArticleTranslation $articleTranslation, ArticleTranslationInterface $translation): Response
    {
        $articleTranslation = $translation->getTranslationBy($articleTranslation->getId());

        return $this->render('admin/article_controller/showArticleTranslations.html.twig', [
            'articleTranslation' => $articleTranslation
        ]);
    }

    /**
     * @Route("/artadmin/articles/{id}/translation/{translation_id}/edit", name="updateArticleTranslation")
     * @ParamConverter("translation", options={"id" = "translation_id"})
     * @param Request $request
     * @param Article $article
     * @param ArticleTranslation $translation
     * @param ArticleTranslationInterface $articleTranslation
     * @return Response
     */
    public function updateArticleTranslation(Request $request, Article $article, ArticleTranslation $translation, ArticleTranslationInterface $articleTranslation): Response
    {
        $model = ArticleMapper::entityTranslationToModel($translation);
        $options['translation'] = true;
        $form = $this->createForm(ContentType::class, $model, $options);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $articleTranslation->updateTranslation($translation, $data);

            return $this->redirectToRoute('showAllArticles');
        }

        return $this->render('admin/article_controller/updateArticleTranslation.html.twig',[
            'form' => $form->createView(),
            'articleTranslation' => $translation
        ]);
    }


}