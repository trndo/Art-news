<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMainController extends AbstractController
{
    /**
     * @Route("/artadmin", name="admin_index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/main_controller/index.html.twig');
    }
}