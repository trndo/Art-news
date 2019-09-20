<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use App\Entity\PictureTranslation;
use App\Form\ContentType;
use App\Form\PictureType;
use App\Mapper\PictureMapper;
use App\Model\PictureModel;
use App\Service\PictureHandler\PictureHandlerInterface;
use App\Service\PictureHandler\PictureTranslationHandlerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * Class AdminPictureHandlerController
 * @package App\Controller\Admin
 */
class AdminPictureHandlerController extends AbstractController
{
    /**
     * @Route("/artadmin/pictures/create", name="createPicture")
     *
     * @param PictureHandlerInterface $pictureHandler
     * @param Request $request
     * @return Response
     */
    public function createPicture(PictureHandlerInterface $pictureHandler, Request $request): Response
    {
        $picture = new PictureModel();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $pictureHandler->createPicture($form->getData());
            return $this->redirectToRoute('pictures');
        }

        return $this->render('admin/picture_controller/createPicture.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/artadmin/pictures/{id}/edit", name="updatePicture")
     *
     * @param PictureHandlerInterface $pictureHandler
     * @param Request $request
     * @return Response
     */
    public function updatePicture(PictureHandlerInterface $pictureHandler, Request $request): Response
    {

    }

    /**
     * @Route("/artadmin/pictures/{id}/create", name="createPictureTranslation")
     *
     * @param Picture $picture
     * @param PictureTranslationHandlerInterface $pictureHandler
     * @param Request $request
     * @return Response
     */
    public function createPictureTranslation(Picture $picture ,PictureTranslationHandlerInterface $pictureHandler, Request $request): Response
    {
        $model = new PictureModel();
        $options['translation'] = true;
        $form = $this->createForm(PictureType::class, $model, $options);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $pictureHandler->createPictureTranslation($picture, $model);
            return $this->redirectToRoute('pictures');
        }

        return $this->render('admin/picture_controller/createPictureTranslation.html.twig', [
            'form' => $form->createView(),
            'picture' => $picture
        ]);
    }

    /**
     * @Route("/artadmin/pictures/{id}/translation/{translation_id}/show", name="showPictureTranslation")
     * @ParamConverter("pictureTranslation", options={"id" = "translation_id"})
     * @param Picture $picture
     * @param PictureTranslation $pictureTranslation
     * @param PictureTranslationHandlerInterface $translation
     * @return Response
     */
    public function showPictureTranslation(Picture $picture, PictureTranslation $pictureTranslation, PictureTranslationHandlerInterface $translation): Response
    {
        $pictureTranslation = $translation->getTranslationBy($pictureTranslation->getId());

        return $this->render('admin/picture_controller/showPictureTranslation.html.twig', [
            'pictureTranslation' => $pictureTranslation
        ]);
    }

    /**
     * @Route("/artadmin/pictures/{id}/translation/{translation_id}/edit", name="updatePictureTranslation")
     * @ParamConverter("translation", options={"id" = "translation_id"})
     * @param Request $request
     * @param Picture $picture
     * @param PictureTranslation $translation
     * @param PictureTranslationHandlerInterface $pictureTranslation
     * @return Response
     */
    public function updatePictureTranslation(Request $request, Picture $picture, PictureTranslation $translation, PictureTranslationHandlerInterface $pictureTranslation): Response
    {
        $model = PictureMapper::entityTranslationToModel($translation);
        $options['translation'] = true;
        $form = $this->createForm(ContentType::class, $model, $options);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $pictureTranslation->updateTranslation($translation, $data);

            return $this->redirectToRoute('pictures');
        }

        return $this->render('admin/picture_controller/updatePictureTranslation.html.twig',[
            'form' => $form->createView(),
            'pictureTranslation' => $translation
        ]);
    }

    /**
     * @Route("/artadmin/pictures/{id}/deleteTranslation", name="deletePictureTranslation")
     * @param PictureTranslation $pictureTranslation
     * @param PictureTranslationHandlerInterface $pictureHandler
     * @return Response
     */
    public function deletePictureTranslation(PictureTranslation $pictureTranslation, PictureTranslationHandlerInterface $pictureHandler): Response
    {
        $pictureHandler->deleteTranslation($pictureTranslation);

        return  $this->redirectToRoute('pictures');
    }

    /**
     * @Route("/artadmin/pictures/{id}/delete", name="deletePicture")
     * @param Picture $picture
     * @param PictureHandlerInterface $pictureHandler
     * @return Response
     */
    public function deletePicture(Picture $picture, PictureHandlerInterface $pictureHandler): Response
    {
        $pictureHandler->deletePicture($picture);

        return  $this->redirectToRoute('pictures');
    }
}