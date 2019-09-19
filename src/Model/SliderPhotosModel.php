<?php

namespace App\Model;

use App\Collection\PictureCollection;

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
     * @param int $start
     */
    private function makeSlidersFromPictures(array $pictures)
    {
        $sliderPictures = [];
        $count = count($pictures);
        $nextSlide = 7;
        for ($i = 0; $i < $count ;$i++) {
            $sliderPictures[] = $pictures[$i];
            if($i == $nextSlide){
                $this->slides[] = new Slide($sliderPictures);
                $sliderPictures = [];
                $nextSlide += 8;
            }
        }
        if(!empty($sliderPictures))
            $this->slides[] = new Slide($sliderPictures);
    }

}