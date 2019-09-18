<?php

namespace App\Controller\Admin;

use App\Form\PictureType;
use App\Model\PictureModel;
use App\Service\PictureHandler\PictureHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPictureHandlerController extends AbstractController
{
    /**
     * @Route("/artadmin/picture/create", name="picture_create")
     *
     * @param PictureHandlerInterface $pictureHandler
     * @param Request $request
     * @return Response
     */
    public function createPicture(PictureHandlerInterface $pictureHandler, Request $request): Response
    {
        $options['translation'] = false;
        $form = $this->createForm(PictureType::class,new PictureModel(), $options);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $pictureHandler->createPicture($form->getData());
            return $this->redirectToRoute('pictures');
        }

        return $this->render('admin/picture_controller/createPicture.html.twig', [
            'form' => $form->createView()
        ]);
    }
}