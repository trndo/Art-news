<?php

namespace App\Model;

use App\Collection\PictureCollection;
use App\Entity\Picture;

class Slide
{
    /**
     * @var array
     */
    private $pictures;

    /**
     * Slide constructor.
     * @param array $pictures
     */
    public function __construct(array $pictures)
    {
        $this->pictures = $pictures;
    }

    /**
     * @return iterable
     */
    public function getPictures(): iterable
    {
        return new PictureCollection($this->pictures);
    }

    /**
     * @param int $key
     * @return Picture|null
     */
    public function get(int $key): ?Picture
    {
        return isset($this->pictures[$key]) ? $this->pictures[$key] : null;
    }

    /**
     * Return a Picture by Position
     * @param int $pos
     * @return Picture|null
     */
    public function position(int $pos): ?Picture
    {
        foreach ($this->pictures as $picture){
            /** @var Picture $picture */
            if($picture->getSliderPosition() == $pos)
                return $picture;
        }

        return null;
    }
}