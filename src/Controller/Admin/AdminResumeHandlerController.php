<?php


namespace App\Controller\Admin;


use App\Entity\Resume;
use App\Entity\ResumeTranslation;
use App\Form\ContentType;
use App\Mapper\ResumeMapper;
use App\Model\ContentModel;
use App\Service\ContentHandler\ResumeHandler\ResumeHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminResumeHandlerController extends AbstractController
{
    /**
     * @Route("/artadmin/articles/create", name="createResumeSlide")
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

            return $this->redirectToRoute('');
        }

        return $this->render('admin/resume_controller/createResumeSlide.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/artadmin/slides/{id}/edit", name="updateResumeSlide")
     * @param Request $request
     * @param ResumeTranslation $resumeTranslation
     * @param ResumeHandlerInterface $resumeHandler
     * @return Response
     */
    public function updateResumeSlide(Request $request, ResumeTranslation $resumeTranslation, ResumeHandlerInterface $resumeHandler): Response
    {
        $model = ResumeMapper::entityToModel($resumeTranslation);
        $form = $this->createForm(ContentType::class,$model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $resumeHandler->updateResumeSlide($data, $resumeTranslation);

            return $this->redirectToRoute('');
        }

        return $this->render('admin/resume_controller/updateResumeSlide.html.twig',[
            'form' => $form->createView()
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

        return  $this->redirectToRoute('');
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

        return  $this->redirectToRoute('');
    }
}