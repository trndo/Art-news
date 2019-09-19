<?php


namespace App\Controller\Admin;


use App\Service\ContentHandler\ResumeHandler\DisplayResumeInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * Class AdminResumeController
 * @package App\Controller\Admin
 */
class AdminResumeController extends AbstractController
{
    /**
     * @Route("/artadmin/slides", name="showAllSlides")
     * @param DisplayResumeInterface $displayResume
     * @return Response
     */
    public function showAllSlides(DisplayResumeInterface $displayResume): Response
    {
        $slides = $displayResume->showSlides();

        return $this->render('admin/resume_controller/showAllSlides.html.twig',[
            'slides' => $slides
        ]);
    }
}