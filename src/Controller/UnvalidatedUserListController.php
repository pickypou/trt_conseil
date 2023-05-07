<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnvalidatedUserController extends AbstractController
{
    #[Route('/unvalidated/user', name: 'app_unvalidated_user')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(User::class);

        $users = $repository->findBy(['isApproved'=>false]);

        return $this->render('admin/unvalidatedUser.html.twig', [
            'users'=>$users,
        ]);

        
    }
}
