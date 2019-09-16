<?php


namespace App\Controller\Api;


use App\Service\ClientService\ClientHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiClientController extends AbstractController
{
    /**
     * @Route("/api/client", methods={"POST"})
     * @param Request $request
     * @param ClientHandlerInterface $clientHandler
     * @return JsonResponse
     */
    public function saveClientCredentials(Request $request, ClientHandlerInterface $clientHandler)
    {
        $phone = $request->request->get('photo');
        $name = $request->request->get('name');

        $clientHandler->saveClientCredentials($phone, $name);

        return new JsonResponse([
            'status' => 'Created!'
        ],201);
    }
}