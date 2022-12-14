<?php

namespace App\Controller;

use App\Entity\MenuCategory;
use App\Form\MenuCategory2Type;
use App\Repository\MenuCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/menu/category')]
class AdminMenuCategoryController extends AbstractController
{
    #[Route('/', name: 'app_admin_menu_category_index', methods: ['GET'])]
    public function index(MenuCategoryRepository $menuCategoryRepository): Response
    {
        return $this->render('admin_menu_category/index.html.twig', [
            'menu_categories' => $menuCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_menu_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MenuCategoryRepository $menuCategoryRepository): Response
    {
        $menuCategory = new MenuCategory();
        $form = $this->createForm(MenuCategory2Type::class, $menuCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuCategoryRepository->add($menuCategory, true);

            return $this->redirectToRoute('app_admin_menu_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_menu_category/new.html.twig', [
            'menu_category' => $menuCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_menu_category_show', methods: ['GET'])]
    public function show(MenuCategory $menuCategory): Response
    {
        return $this->render('admin_menu_category/show.html.twig', [
            'menu_category' => $menuCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_menu_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MenuCategory $menuCategory, MenuCategoryRepository $menuCategoryRepository): Response
    {
        $form = $this->createForm(MenuCategory2Type::class, $menuCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuCategoryRepository->add($menuCategory, true);

            return $this->redirectToRoute('app_admin_menu_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_menu_category/edit.html.twig', [
            'menu_category' => $menuCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_menu_category_delete', methods: ['POST'])]
    public function delete(Request $request, MenuCategory $menuCategory, MenuCategoryRepository $menuCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menuCategory->getId(), $request->request->get('_token'))) {
            $menuCategoryRepository->remove($menuCategory, true);
        }

        return $this->redirectToRoute('app_admin_menu_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
