<?php


namespace App\Mapper;


use App\Entity\PictureTranslation;
use App\Model\ContentModel;

final class PictureMapper
{
    public static function entityTranslationToModel(PictureTranslation $articleTranslation): ContentModel
    {
        $model = new ContentModel();

        $article = $articleTranslation->getPicture();

        $model->setBody($articleTranslation->getBody())
            ->setTitle($articleTranslation->getTitle())
            ->setLocale($articleTranslation->getLocale());

        return $model;

    }
}