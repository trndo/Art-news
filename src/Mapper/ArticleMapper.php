<?php


namespace App\Mapper;


use App\Entity\ArticleTranslation;
use App\Model\ContentModel;

final class ArticleMapper
{
    public static function entityToModel(ArticleTranslation $articleTranslation): ContentModel
    {
        $model = new ContentModel();

        $article = $articleTranslation->getArticle();

        $model->setBody($articleTranslation->getBody())
            ->setTitle($articleTranslation->getTitle())
            ->setPhoto($article->getPhoto());

        return $model;

    }
}