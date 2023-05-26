<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UsersListController extends AbstractController
{
    #[Route('/users/list', name: 'app_users_list')]
    public function index( ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(User::class);
        $users = $repository->findAll();
       
        return $this->render('admin/listUsers.html.twig',[
            'users'=>$users
        ]);
    }
}
