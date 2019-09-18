<?php

namespace App\Service\PictureHandler;

use App\Collection\PictureCollection;
use App\Model\PictureModel;

interface PictureHandlerInterface
{
    /**
     * Get all pictures
     * @return PictureCollection
     */
    public function getAllPictures(): PictureCollection;

    /**
     * create new Picture
     * @param PictureModel $pictureModel
     */
    public function createPicture(PictureModel $pictureModel): void;

}