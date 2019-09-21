<?php


namespace App\Mapper;


use App\Entity\Picture;
use App\Entity\PictureTranslation;
use App\Model\ContentModel;
use App\Model\PictureModel;
use App\Model\UpdatePictureModel;

final class PictureMapper
{
    public static function entityTranslationToModel(PictureTranslation $pictureTranslation): ContentModel
    {
        $model = new ContentModel();

        $picture = $pictureTranslation->getPicture();

        $model->setBody($pictureTranslation->getBody())
            ->setTitle($pictureTranslation->getTitle())
            ->setLocale($pictureTranslation->getLocale());

        return $model;

    }

    public static function entityToModel(Picture $picture): UpdatePictureModel
    {

        $model = new UpdatePictureModel();

        $model->setPhoto($picture->getPhoto())
            ->setPhotos($picture->getPhotos()->toArray());

        return $model;

    }
}