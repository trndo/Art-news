<?php

namespace App\Service\PictureHandler;

use App\Collection\PictureCollection;
use App\Entity\Picture;
use App\Model\PictureModel;
use App\Model\UpdatePictureModel;

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

    /**
     * @param UpdatePictureModel $model
     * @param Picture $picture
     * @param array $photos
     */
    public function updatePicture(UpdatePictureModel $model, Picture $picture, array $photos): void ;

    /**
     * @param Picture $picture
     */
    public function deletePicture(Picture $picture): void;

    /**
     * Get all pictures that placed on slider
     * @return PictureCollection
     */
    public function getPicturesInSlider(): PictureCollection;

    /**
     * Add position for picture in slider
     * @param int $picture Picture id
     * @param int $position Position on slider
     */
    public function addPictureOnSlide(int $picture, int $position): void;
}