<?php


namespace App\Controller\Admin;


use App\Entity\Resume;
use App\Entity\ResumeTranslation;
use App\Form\ContentType;
use App\Form\SlidePhotoType;
use App\Mapper\ResumeMapper;
use App\Model\ContentModel;
use App\Service\ContentHandler\ResumeHandler\ResumeHandlerInterface;
use App\Service\ContentHandler\ResumeHandler\ResumeTranslationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminResumeHandlerController extends AbstractController
{
    /**
     * @Route("/artadmin/slides/create", name="createResumeSlide")
     * @param Request $request
     * @param ResumeHandlerInterface $resumeHandler
     * @return Response
     */
    public function createResumeSlide(Request $request, ResumeHandlerInterface $resumeHandler): Response
    {
        $model = new ContentModel();
        $form = $this->createForm(ContentType::class,$model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $resumeHandler->createResumeSlide($data);

            return $this->redirectToRoute('showAllSlides');
        }

        return $this->render('admin/resume_controller/createResumeSlide.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/artadmin/slides/{id}/edit", name="updateResumeSlide")
     * @param Request $request
     * @param Resume $resume
     * @param ResumeHandlerInterface $resumeHandler
     * @return Response
     */
    public function updateResumeSlide(Request $request, Resume $resume, ResumeHandlerInterface $resumeHandler): Response
    {
        $form = $this->createForm(SlidePhotoType::class, $resume);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $photo = $request->files->get('slide_photo')['photo'];
            $resumeHandler->updateResumePhoto($data, $photo);

            return $this->redirectToRoute('showAllSlides');
        }

        return $this->render('admin/resume_controller/updateResumeSlide.html.twig', [
            'form' => $form->createView(),
            'slide' => $resume
        ]);
    }

    /**
     * @Route("/artadmin/slides/{id}/deleteTranslation", name="deleteResumeTranslation")
     * @param ResumeTranslation $resumeTranslation
     * @param ResumeHandlerInterface $resumeHandler
     * @return Response
     */
    public function deleteResumeTranslation(ResumeTranslation $resumeTranslation, ResumeHandlerInterface $resumeHandler): Response
    {
        $resumeHandler->deleteTranslation($resumeTranslation);

        return  $this->redirectToRoute('showAllSlides');
    }

    /**
     * @Route("/artadmin/slides/{id}/delete", name="deleteResumeSlide")
     * @param Resume $resume
     * @param ResumeHandlerInterface $resumeHandler
     * @return Response
     */
    public function deleteResumeSlide(Resume $resume, ResumeHandlerInterface $resumeHandler): Response
    {
        $resumeHandler->deleteResumeSlide($resume);

        return  $this->redirectToRoute('showAllSlides');
    }

    /**
     * @Route("/artadmin/slides/{id}/translation/{translation_id}/show", name="showResumeTranslation")
     * @ParamConverter("resumeTranslation", options={"id" = "translation_id"})
     * @param Resume $resume
     * @param ResumeTranslation $resumeTranslation
     * @param ResumeTranslationInterface $translation
     * @return Response
     */
    public function showResumeTranslation(Resume $resume, ResumeTranslation $resumeTranslation, ResumeTranslationInterface $translation): Response
    {
        $resumeTranslation = $translation->getTranslationBy($resumeTranslation->getId());

        return $this->render('admin/resume_controller/showResumeTranslation.html.twig', [
            'resumeTranslation' => $resumeTranslation
        ]);
    }

    /**
     * @Route("/artadmin/slides/{id}/translation/create", name="createResumeTranslationFor")
     * @param Request $request
     * @param Resume $resume
     * @param ResumeTranslationInterface $resumeTranslation
     * @return Response
     */
    public function createResumeTranslation(Request $request, Resume $resume, ResumeTranslationInterface $resumeTranslation): Response
    {
        $model = new ContentModel();
        $options['translation'] = true;
        $form = $this->createForm(ContentType::class, $model, $options);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $resumeTranslation->createResumeTranslation($resume, $data);

            return $this->redirectToRoute('showAllSlides');
        }

        return $this->render('admin/resume_controller/addResumeTranslation.html.twig', [
            'form' => $form->createView(),
            'slide' => $resume
        ]);
    }

    /**
     * @Route("/artadmin/slides/{id}/translation/{translation_id}/edit", name="updateResumeTranslation")
     * @ParamConverter("translation", options={"id" = "translation_id"})
     * @param Request $request
     * @param Resume $resume
     * @param ResumeTranslation $translation
     * @param ResumeTranslationInterface $resumeTranslation
     * @return Response
     */
    public function updateResumeTranslation(Request $request, Resume $resume, ResumeTranslation $translation, ResumeTranslationInterface $resumeTranslation): Response
    {
        $model = ResumeMapper::entityTranslationToModel($translation);
        $options['translation'] = true;
        $form = $this->createForm(ContentType::class, $model, $options);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $resumeTranslation->updateTranslation($translation, $data);

            return $this->redirectToRoute('showAllSlides');
        }

        return $this->render('admin/resume_controller/updateResumeTranslation.html.twig',[
            'form' => $form->createView(),
            'resumeTranslation' => $translation
        ]);
    }
}