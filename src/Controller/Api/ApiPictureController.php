<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiPictureController extends AbstractController
{
    /**
     * @Route("/api/nextSlide", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function getNextSlide(Request $request): Response
    {
       $counter =  $request->query->getInt('counter');
       $slide = $request->query->getInt('slide');

       return $this->render('admin/elements/slide.html.twig', [
           'counter' => $counter,
           'slide' => $slide
       ]);
    }
}