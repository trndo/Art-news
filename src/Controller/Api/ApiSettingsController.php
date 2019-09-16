<?php


namespace App\Controller\Api;


use App\Service\SettingsHandler\SettingsHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiSettingsController extends AbstractController
{
    /**
     * @Route("/api/settings", methods={"GET"})
     * @param SettingsHandlerInterface $settingsHandler
     * @return JsonResponse
     */
    public function getSettings(SettingsHandlerInterface $settingsHandler): JsonResponse
    {
        $settings = $settingsHandler->showSettings();

        return new JsonResponse([
            'settings' => $settings
        ],200);
    }
}