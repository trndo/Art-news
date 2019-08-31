<?php


namespace App\Collection;


use Traversable;

class ResumeCollection implements \IteratorAggregate
{
    /**
     * @var array
     */
    private $slides;

    public function __construct(array $slides)
    {
        $this->slides = $slides;
    }

    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->slides);
    }
}