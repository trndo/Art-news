<?php


namespace App\Controller\Admin;


use App\Service\ContentHandler\ResumeHandler\DisplayResumeArticle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminResumeController extends AbstractController
{
    /**
     * @Route("/artadmin/slides", name="showAllSlides")
     * @param DisplayResumeArticle $displayResumeArticle
     * @return Response
     */
    public function showAllSlides(DisplayResumeArticle $displayResumeArticle): Response
    {
        $slides = $displayResumeArticle->showSlides();

        return $this->render('admin/resume_controller/showAllSlides.html.twig',[
            'slides' => $slides
        ]);
    }
}