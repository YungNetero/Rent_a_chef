<?php

namespace App\Controller;

use App\Entity\MenuImg;
use App\Form\MenuImgType;
use App\Repository\MenuImgRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/menu/img')]
class MenuImgController extends AbstractController
{
    #[Route('/', name: 'app_menu_img_index', methods: ['GET'])]
    public function index(MenuImgRepository $menuImgRepository): Response
    {
        return $this->render('menu_img/index.html.twig', [
            'menu_imgs' => $menuImgRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_menu_img_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MenuImgRepository $menuImgRepository): Response
    {
        $menuImg = new MenuImg();
        $form = $this->createForm(MenuImgType::class, $menuImg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuImgRepository->add($menuImg, true);

            return $this->redirectToRoute('app_menu_img_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu_img/new.html.twig', [
            'menu_img' => $menuImg,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_menu_img_show', methods: ['GET'])]
    public function show(MenuImg $menuImg): Response
    {
        return $this->render('menu_img/show.html.twig', [
            'menu_img' => $menuImg,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_menu_img_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MenuImg $menuImg, MenuImgRepository $menuImgRepository): Response
    {
        $form = $this->createForm(MenuImgType::class, $menuImg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuImgRepository->add($menuImg, true);

            return $this->redirectToRoute('app_menu_img_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu_img/edit.html.twig', [
            'menu_img' => $menuImg,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_menu_img_delete', methods: ['POST'])]
    public function delete(Request $request, MenuImg $menuImg, MenuImgRepository $menuImgRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menuImg->getId(), $request->request->get('_token'))) {
            $menuImgRepository->remove($menuImg, true);
        }

        return $this->redirectToRoute('app_menu_img_index', [], Response::HTTP_SEE_OTHER);
    }
}
