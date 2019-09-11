<?php


namespace App\Collection;


use Traversable;

class ArticleCollection implements \IteratorAggregate
{
    /**
     * @var array|null
     */
    private $articles;

    public function __construct(?array $articles)
    {
        $this->articles = $articles;
    }

    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->articles);
    }
}