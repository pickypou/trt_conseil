<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnvalidatedUserController extends AbstractController
{
    #[Route('/unvalidated/user', name: 'app_unvalidated_user')]
    public function index(ManagerRegistry $doctrine, UserRepository $userRepository): Response
    {
        $unvalidatedUsers = $userRepository->findUnvalidatedUsers();
       

        return $this->render('admin/unvalidatedUser.html.twig', [
            'users'=>$unvalidatedUsers,
        ]);

        
    }
}
