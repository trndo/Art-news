<?php


namespace App\Controller\Admin;


use App\Service\PictureHandler\PictureHandlerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * Class AdminPictureController
 * @package App\Controller\Admin
 */
class AdminPictureController extends AbstractController
{
    /**
     * @Route("/artadmin/pictures", name="pictures")
     * @param PictureHandlerInterface $pictureHandler
     * @return Response
     */
    public function showPictures(PictureHandlerInterface $pictureHandler): Response
    {
        $pictures = $pictureHandler->getAllPictures();
        return $this->render('admin/picture_controller/showPictures.html.twig', [
            'pictures' => $pictures
        ]);
    }
}