<?php


namespace App\Mapper;
use App\Entity\ResumeTranslation;
use App\Model\ContentModel;

final class ResumeMapper
{
    public static function entityToModel(ResumeTranslation $resumeTranslation): ContentModel
    {
        $model = new ContentModel();

        $resume = $resumeTranslation->getResume();

        $model->setBody($resumeTranslation->getBody())
            ->setTitle($resumeTranslation->getTitle())
            ->setPhoto($resume->getPhoto());

        return $model;
    }
}