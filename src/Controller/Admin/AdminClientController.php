<?php


namespace App\Controller\Admin;


use App\Service\ClientService\ClientHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminClientController extends AbstractController
{
    public function showClients(ClientHandlerInterface $clientHandler): Response
    {
        $clients = $clientHandler->getAllClients();

        return $this->render('admin/client_controller/showClients.html.twig',[
           'clients' => $clients
        ]);
    }
}