<?php

namespace App\Controller;

use App\Entity\UserEnexse;
use App\Form\UserEnexseType;
use App\Repository\UserEnexseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/enexse')]
class UserEnexseController extends AbstractController
{
    #[Route('/', name: 'app_user_enexse_index', methods: ['GET'])]
    public function index(UserEnexseRepository $userEnexseRepository): Response
    {
        return $this->render('user_enexse/index.html.twig', [
            'user_enexses' => $userEnexseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_enexse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserEnexseRepository $userEnexseRepository): Response
    {
        $userEnexse = new UserEnexse();
        $form = $this->createForm(UserEnexseType::class, $userEnexse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userEnexseRepository->save($userEnexse, true);

            return $this->redirectToRoute('app_user_enexse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_enexse/new.html.twig', [
            'user_enexse' => $userEnexse,
            'form' => $form,
        ]);
    }

    #[Route('/{userid}', name: 'app_user_enexse_show', methods: ['GET'])]
    public function show(UserEnexse $userEnexse): Response
    {
        return $this->render('user_enexse/show.html.twig', [
            'user_enexse' => $userEnexse,
        ]);
    }

    #[Route('/{userid}/edit', name: 'app_user_enexse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserEnexse $userEnexse, UserEnexseRepository $userEnexseRepository): Response
    {
        $form = $this->createForm(UserEnexseType::class, $userEnexse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userEnexseRepository->save($userEnexse, true);

            return $this->redirectToRoute('app_user_enexse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_enexse/edit.html.twig', [
            'user_enexse' => $userEnexse,
            'form' => $form,
        ]);
    }

    #[Route('/{userid}', name: 'app_user_enexse_delete', methods: ['POST'])]
    public function delete(Request $request, UserEnexse $userEnexse, UserEnexseRepository $userEnexseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userEnexse->getUserid(), $request->request->get('_token'))) {
            $userEnexseRepository->remove($userEnexse, true);
        }

        return $this->redirectToRoute('app_user_enexse_index', [], Response::HTTP_SEE_OTHER);
    }
}
