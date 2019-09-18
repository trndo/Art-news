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
    private function makeSlidersFromPictures(array $pictures, int $start = 0)
    {
        $sliderPictures = [];
        for ($i = $start; $i < $start + 8;$i++) {
            if(isset($pictures[$i])){
                $sliderPictures[] = $pictures[$i];
            }
            else {
                if(!empty($sliderPictures))
                    $this->slides[] = new Slide($sliderPictures);
                return;
            }
        }

        $this->slides[] = new Slide($sliderPictures);
        $this->makeSlidersFromPictures($pictures,$start + 8);
    }

}