<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EspaceAdminController extends AbstractController
{
    #[Route('/espace/admin', name: 'app_espace_admin')]
    public function index(): Response
    {
        return $this->render('espace_admin/index.html.twig', [
            'controller_name' => 'EspaceAdminController',
        ]);
    }
}
