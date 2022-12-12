<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserFormType;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Exception as DoctrineException;

class UsersController extends AbstractController
{   
    /////// Add User //////////////
    #[Route('/api/v1/agent', name: 'add_user')]
    public function postUser(Request $request, ManagerRegistry $doctrine): Response
    {   
        try {
            $error = "";
            $doc_db = $doctrine->getManager(); //
            $user = new Users();

            $userForm = $this->createForm(UserFormType::class, $user);
            $userForm->handleRequest($request);


            if ($userForm->isSubmitted() && $userForm->isValid()) {

                $doc_db->persist($user);
                $doc_db->flush();

                return $this->redirectToRoute('add_user');
            }
        } catch (DoctrineException $e) {
            $error = 'Erreur en base de données : ' . $e->getMessage();
        }
        return $this->render('base.html.twig',[
            'error' => $error,
            'form' => $userForm->createView(),
            'updating' => false
        ]);
    }

    /////////////////// All Users ////////////////////////
    #[Route('/api/v1/agents', name: 'all_users')]
    public function getUsers(UsersRepository $usersRepository): JsonResponse
    {   
        foreach ($usersRepository->findBy([], ['userid' => 'ASC']) as $result) {
            $users[] = [
                'identifiant' => $result->getUserid(),
                'email' => $result->getEmail(),
                'nom' => $result->getUsername(),
                'prénom' => $result->getFullname(),
                'adresse' => $result->getUserAdress(),
                'contact' => $result->getUserContact(),
                'Date de Naissance' => $result->getDateOfBirth(),
                'roles' => $result->getRoles(),
                'Date d\'enregistrement' => $result->getCreatedAt()
            ];
        }

        return $this->json([
            'user' => $users,
            'path' => 'src/Controller/UsersController.php',
        ]);
    }

    //////////   Edit user //////////////////
    #[Route('/api/v1/{userid}', name: 'edit_user')]
    public function putUser(UsersRepository $usersRepository, string $userid, ManagerRegistry $doctrine, Request $request): Response
    {   
        try {
            $error = "";
            $entityManager = $doctrine->getManager();
            $user = $usersRepository->findOneBy(['userid' => $userid]);
            $userForm = $this->createForm(UserFormType::class, $user);
            $$userForm->handleRequest($request);

            if (!$user) {
                throw $this->createNotFoundException(
                    'No product found for id ' . $userid
                );
            }

            if ($userForm->isSubmitted() && $userForm->isValid()) {

                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('all_users');
            }
        } catch (DoctrineException $e) {
            $error = 'Erreur en base de données : ' . $e->getMessage();
        }

        return $this->render('base.html.twig',[
            'error' => $error,
            'form' => $userForm->createView(),
            'updating' => true
        ]);
    }


    //////////   Delete user //////////////////
    #[Route('/api/v1/{userid}', name: 'delete_user')]
    public function deleteUser(UsersRepository $usersRepository, string $userid, ManagerRegistry $doctrine): Response
    {   
        
        $entityManager = $doctrine->getManager();
        $user = $usersRepository->findOneBy(['userid' => $userid]);
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('all_users');
    }

}
