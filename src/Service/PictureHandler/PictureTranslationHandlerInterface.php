<?php

namespace App\Service\PictureHandler;

use App\Entity\Picture;
use App\Entity\PictureTranslation;
use App\Model\ContentModel;
use App\Model\PictureModel;

interface PictureTranslationHandlerInterface
{
    /**
     * create Picture Translation
     * @param Picture $picture
     * @param PictureModel $model
     */
    public function createPictureTranslation(Picture $picture, PictureModel $model): void;

    /**
     * @param int|null $id
     * @return PictureTranslation|null
     */
    public function getTranslationBy(?int $id): ?PictureTranslation;

    /**
     * @param PictureTranslation $pictureTranslation
     * @param ContentModel $model
     */
    public function updateTranslation(PictureTranslation $pictureTranslation, ContentModel $model): void;

    /**
     * @param PictureTranslation $articleTranslation
     */
    public function deleteTranslation(PictureTranslation $articleTranslation): void;
}