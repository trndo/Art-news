<?php


namespace App\Service\ClientService;


use App\Collection\ClientsCollection;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientHandler implements ClientHandlerInterface
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ClientRepository $clientRepository)
    {
        $this->entityManager = $entityManager;
        $this->clientRepository = $clientRepository;
    }

    public function saveClientCredentials(?string $phone, ?string $name): void
    {
        $client = new Client();
        $client->setName($name)
            ->setPhone($phone);

        $this->entityManager->persist($client);
        $this->entityManager->flush();
    }

    public function getAllClients(): ?ClientsCollection
    {
        return new ClientsCollection($this->clientRepository->findAll());
    }


}