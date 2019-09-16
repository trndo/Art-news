<?php


namespace App\Service\ClientService;


use App\Collection\ClientsCollection;

interface ClientHandlerInterface
{
    public function saveClientCredentials(?string $phone, ?string $name): void ;

    public function getAllClients(): ?ClientsCollection;
}