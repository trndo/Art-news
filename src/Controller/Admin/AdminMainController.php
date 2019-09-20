<?php

namespace App\Controller\Admin;

<<<<<<< HEAD
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
=======
use App\Model\SliderPhotosModel;
use App\Service\PictureHandler\PictureHandlerInterface;
>>>>>>> 2643faf17dec7917982f0d58dd4d6c294f25c39b
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * Class AdminMainController
 * @package App\Controller\Admin
 */
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