<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpaController extends AbstractController
{
    /**
     * @Route(path="/{spa_route}", name="spa", requirements={ "spa_route" = ".*" })
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('spa/spa.html.twig');
    }
}