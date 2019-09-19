<?php

namespace App\Controller\Admin;

use App\Model\SliderPhotosModel;
use App\Service\PictureHandler\PictureHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMainController extends AbstractController
{
    /**
     * @Route("/artadmin", name="admin_index")
     * @param PictureHandlerInterface $pictureHandler
     * @return Response
     */
    public function index(PictureHandlerInterface $pictureHandler): Response
    {
        $sliderContainer = new SliderPhotosModel($pictureHandler->getPicturesInSlider());
        return $this->render('admin/main_controller/index.html.twig',[
            'sliderContainer' => $sliderContainer
        ]);
    }
}