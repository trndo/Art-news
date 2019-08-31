<?php


namespace App\Controller\Admin;


use App\Service\SettingsHandler\SettingsHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSettingsHandler extends AbstractController
{
    /**
     * @Route("/artadmin/settings", name="showSettings")
     * @param SettingsHandlerInterface $settingsHandler
     * @return Response
     */
    public function showSettings(SettingsHandlerInterface $settingsHandler): Response
    {
        $settings = $settingsHandler->showSettings();

        return $this->render('settings_controller/showSettings.html.twig',[
            'settings' => $settings
        ]);
    }

}