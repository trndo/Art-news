<?php


namespace App\Controller\Api;


use App\Service\ContentHandler\ResumeHandler\DisplayResumeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiResumeController extends AbstractController
{
    /**
     * @Route("/api/slides", methods={"GET"})
     *
     * @param Request $request
     * @param DisplayResumeInterface $displayResume
     * @return JsonResponse
     */
    public function getSlides(Request $request, DisplayResumeInterface $displayResume): JsonResponse
    {
        $locale = $request->query->get('locale');
        $slides = $displayResume->showSlides($locale);

        return new JsonResponse([
            'slides' => $slides
        ],200);
    }
}