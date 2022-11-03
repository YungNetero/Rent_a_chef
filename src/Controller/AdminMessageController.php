<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\Message2Type;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/message')]
class AdminMessageController extends AbstractController
{
    #[Route('/', name: 'app_admin_message_index', methods: ['GET'])]
    public function index(MessageRepository $messageRepository): Response
    {
        return $this->render('admin_message/index.html.twig', [
            'messages' => $messageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_message_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MessageRepository $messageRepository): Response
    {
        $message = new Message();
        $form = $this->createForm(Message2Type::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messageRepository->add($message, true);

            return $this->redirectToRoute('app_admin_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_message/new.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_message_show', methods: ['GET'])]
    public function show(Message $message): Response
    {
        return $this->render('admin_message/show.html.twig', [
            'message' => $message,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_message_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Message $message, MessageRepository $messageRepository): Response
    {
        $form = $this->createForm(Message2Type::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messageRepository->add($message, true);

            return $this->redirectToRoute('app_admin_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_message/edit.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_message_delete', methods: ['POST'])]
    public function delete(Request $request, Message $message, MessageRepository $messageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
            $messageRepository->remove($message, true);
        }

        return $this->redirectToRoute('app_admin_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
