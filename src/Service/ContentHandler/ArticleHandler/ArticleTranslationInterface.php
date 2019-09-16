<?php


namespace App\Service\ContentHandler\ArticleHandler;


use App\Entity\Article;
use App\Entity\ArticleTranslation;
use App\Model\ContentModel;

interface ArticleTranslationInterface
{
    /**
     * @param Article $article
     * @param ContentModel $model
     */
    public function createArticleTranslation(Article $article, ContentModel $model): void;

    public function getTranslationBy(?int $id): ?ArticleTranslation;

    public function updateTranslation(ArticleTranslation $articleTranslation, ContentModel $model): void ;


}