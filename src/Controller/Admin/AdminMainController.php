<?php

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * Class AdminMainController
 * @package App\Controller\Admin
 */
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