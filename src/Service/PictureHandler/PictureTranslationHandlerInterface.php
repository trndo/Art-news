<?php

namespace App\Service\PictureHandler;

use App\Entity\Picture;
use App\Model\PictureModel;

interface PictureTranslationHandlerInterface
{
    /**
     * create Picture Translation
     * @param Picture $picture
     * @param PictureModel $model
     */
    public function createPictureTranslation(Picture $picture, PictureModel $model): void;
}