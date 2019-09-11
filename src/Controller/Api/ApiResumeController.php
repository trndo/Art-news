<?php


namespace App\Controller\Api;


use App\Service\ContentHandler\ResumeHandler\DisplayResumeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiResumeController extends AbstractController
{
    /**
     * @Route("/api/slides", methods={"GET"})
     *
     * @param DisplayResumeInterface $displayResume
     * @return JsonResponse
     */
    public function getSlides(DisplayResumeInterface $displayResume): JsonResponse
    {
        $slides = $displayResume->showSlides();

        return new JsonResponse([
            'slides' => $slides
        ],200);
    }
}