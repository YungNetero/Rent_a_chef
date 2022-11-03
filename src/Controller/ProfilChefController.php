<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilChefController extends AbstractController
{
    #[Route('/profil/chef/{id}', name: 'app_profil_chef',methods:['GET'])]
    public function index(UserRepository $userRepository, User $user): Response
     {
       
        return $this->render('profil_chef/index.html.twig', [
            'chef' => $user,
        ]);
    }
}
