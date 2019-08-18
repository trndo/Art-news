<?php


namespace App\Controller;

use App\Entity\Article;
use App\Form\ContentType;
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
        $this->createForm(ContentType::class, new Article())->getData();

        return $this->render('spa/spa.html.twig');
    }
}