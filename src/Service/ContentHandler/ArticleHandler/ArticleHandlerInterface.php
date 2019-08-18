<?php


namespace App\Service\ContentHandler\ResumeHandler;


use App\Entity\Article;
use App\Entity\ArticleTranslation;
use App\Model\ContentModel;

interface ArticleHandlerInterface
{
    /**
     * @param ContentModel $model
     */
    public function createArticle(ContentModel $model): void;

    /**
     * @param Article $article
     */
    public function deleteArticle(Article $article): void;

    /**
     * @param ArticleTranslation $articleTranslation
     */
    public function deleteTranslation(ArticleTranslation $articleTranslation): void;

    /**
     * @param ContentModel $model
     * @param ArticleTranslation $articleTranslation
     */
    public function updateArticle(ContentModel $model, ArticleTranslation $articleTranslation): void;

}