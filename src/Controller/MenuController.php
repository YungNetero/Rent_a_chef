<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 // #[Route('/chef/')]
class MenuController extends AbstractController
{
    #[Route('/chef/menu', name: 'app_menu_index', methods: ['GET'])]
    public function index(MenuRepository $menuRepository): Response
    {
        return $this->render('menu/index.html.twig', [
            'menus' => $menuRepository->findAll(),
        ]);
    }

    #[Route('/chef/{uid}/menu', name: 'app_menu_chef', methods: ['GET'])] 
    public function menuListByChefId(MenuRepository $menuRepository, UserRepository $userRepository, $uid): Response // route pour le menu du chef selon son Id
    {
        $user = $userRepository->find($uid);
        if (in_array('ROLE_CHEF', $user->getRoles())) {
            $menus = $menuRepository->findBy(['user' => $uid ]);
       
            return $this->render('menu/chefMenuList.html.twig', [
                'menus' => $menus,
            ]);
        } else {
            // Ici, soit une redirection vers la page d'accueil soit une redirection vers la liste des chef
            return $this->redirectToRoute('app_home');
        }
    }

    #[Route('/chef/menu/new', name: 'app_menu_new', methods: ['GET', 'POST'])] // route vers le create menu
    public function new(Request $request, ManagerRegistry $managerRegistry,): Response
    {
        //  Bloquer la route à tous les utilisateurs qui n'ont pas le role ROLE_CHEF ( faire une condition)

        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $menu->setUser($this->getUser());
            $img1 = $form->get('img1')->getData();
            $imgName = time() . '.' . $img1->guessExtension();
            $menu->setImg1($imgName); 
            $img1->move($this->getParameter('menuImgDir'), $imgName); 

            $img2 = $form->get('img2')->getData();
            if ($img2) {
                $imgName = time() . '.' . $img2->guessExtension();
                $menu->setImg1($imgName); 
                $img2->move($this->getParameter('menuImgDir'), $imgName);
            }
            
            $img3 = $form->get('img3')->getData();
            if ($img3) {
                $imgName = time() . '.' . $img3->guessExtension();
                $menu->setImg3($imgName); 
                $img1->move($this->getParameter('menuImgDir'), $imgName);
            }
            $manager = $managerRegistry->getManager();
            $manager->persist($menu);
            $manager->flush();
            // persister l'objet
            // envoi en bdd

            return $this->redirectToRoute('app_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/new.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }

    #[Route('/chef/menu/show/{id}', name: 'app_menu_show', methods: ['GET'])]
    public function show(Menu $menu): Response
    {
        return $this->render('menu/show.html.twig', [
            'menu' => $menu,
        ]);
    }

    #[Route('/chef/menu/{id}/edit', name: 'app_menu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Menu $menu, MenuRepository $menuRepository): Response
    {
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuRepository->add($menu, true);

            return $this->redirectToRoute('app_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/edit.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }

    #[Route('/chef/menu/{id}', name: 'app_menu_delete', methods: ['POST'])]
    public function delete(Request $request, Menu $menu, MenuRepository $menuRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menu->getId(), $request->request->get('_token'))) {
            $menuRepository->remove($menu, true);
        }

        return $this->redirectToRoute('app_menu_index', [], Response::HTTP_SEE_OTHER);
    }
}