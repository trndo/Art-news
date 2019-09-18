<?php

namespace App\Collection;

class PictureCollection implements \IteratorAggregate
{
    /**
     * @var array
     */
    private $pictures;

    /**
     * PictureCollection constructor.
     * @param array $pictures
     */
    public function __construct(array $pictures)
    {
        $this->pictures = $pictures;
    }

    /**
     * @return iterable
     */
    public function getIterator(): iterable
    {
       return new \ArrayIterator($this->pictures);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->pictures;
    }
}