<?php


namespace App\Controller\Admin;


use App\Entity\Settings;
use App\Form\SettingsType;
use App\Service\SettingsHandler\SettingsHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSettingsController extends AbstractController
{
    /**
     * @Route("/artadmin/settings/create", name="createSettings")
     * @param Request $request
     * @param SettingsHandlerInterface $settingsHandler
     * @return Response
     */
    public function createSettings(Request $request, SettingsHandlerInterface $settingsHandler): Response
    {
        $settings = new Settings();
        $form = $this->createForm(SettingsType::class, $settings);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $settingsHandler->createSettings($data);

            return $this->redirectToRoute('showSettings');
        }

        return $this->render('admin/settings_controller/createSettings.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/artadmin/settings/{id}/edit", name="updateSettings")
     * @param Request $request
     * @param Settings $settings
     * @param SettingsHandlerInterface $settingsHandler
     * @return Response
     */
    public function updateSettings(Request $request,Settings $settings, SettingsHandlerInterface $settingsHandler): Response
    {
        $form = $this->createForm(SettingsType::class, $settings);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $settingsHandler->updateSettings($data);

            return $this->redirectToRoute('showSettings');
        }

        return $this->render('admin/settings_controller/updateSettings.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/artadmin/settings/{id}/delete", name="deleteSettings")
     * @param Settings $settings
     * @param SettingsHandlerInterface $settingsHandler
     * @return Response
     */
    public function deleteSettings(Settings $settings, SettingsHandlerInterface $settingsHandler): Response
    {
        $settingsHandler->deleteSettings($settings);

       return $this->redirectToRoute('showSettings');
    }
}