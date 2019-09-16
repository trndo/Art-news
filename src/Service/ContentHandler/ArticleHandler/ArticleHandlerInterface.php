<?php


namespace App\Service\ContentHandler\ArticleHandler;


use App\Entity\Article;
use App\Entity\ArticleTranslation;
use App\Model\ContentModel;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
    public function updateArticleTranslation(ContentModel $model, ArticleTranslation $articleTranslation): void;

    /**
     * @param Article $article
     * @param UploadedFile|null $file
     */
    public function updatePhoto(Article $article, ?UploadedFile $file): void;

}