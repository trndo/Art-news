<?php

namespace App\Model;

use App\Collection\PictureCollection;
use App\Entity\Picture;

class SliderPhotosModel
{
    /**
     * @var array
     */
    private $slides = [];

    /**
     * SliderPhotosModel constructor.
     * @param PictureCollection $pictureCollection
     */
    public function __construct(PictureCollection $pictureCollection)
    {
        $this->makeSlidersFromPictures($pictureCollection->toArray());
    }

    /**
     * @return int
     */
    public function countSlides(): int
    {
        return count($this->slides);
    }

    /**
     * @return array
     */
    public function getSlides(): array
    {
        return $this->slides;
    }

    /**
     * @param array $pictures
     */
    private function makeSlidersFromPictures(array $pictures)
    {
        $sliderPictures = [];
        $starterPos = 1;
        $finishPos = 8;
        
        foreach ($pictures as $picture){
            $this->recursiveCheck($picture,$sliderPictures,$starterPos,$finishPos);
        }
        if(!empty($sliderPictures)) {
            $this->slides[] = new Slide($sliderPictures);
            $sliderPictures = [];
        }
    }
    
    public function recursiveCheck(Picture $picture, array &$sliderPictures, int &$starterPos, int &$finishPos)
    {
        $currentPos = $picture->getSliderPosition();
        if($currentPos <= $finishPos && $currentPos >= $starterPos){
            $sliderPictures[] = $picture;
            return;
        }
        else{
            $starterPos = $finishPos;
            $finishPos += 8;
            if(!empty($sliderPictures)) {
                $this->slides[] = new Slide($sliderPictures);
                $sliderPictures = [];
            }
            $this->recursiveCheck($picture,$sliderPictures,$starterPos,$finishPos);
        }
    }
}