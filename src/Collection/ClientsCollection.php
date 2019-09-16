<?php


namespace App\Collection;


use Traversable;

class ClientsCollection implements \IteratorAggregate
{
    /**
     * @var array
     */
    private $clients;

    public function __construct(array $clients)
    {
        $this->clients = $clients;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->clients);
    }


}