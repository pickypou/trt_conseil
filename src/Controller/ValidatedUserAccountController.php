<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ValidatedUserAccountController extends AbstractController
{
   
   
    #[Route('/validated/user/account', name: 'app_validated_user_account')]
    public function index(User $user, ManagerRegistry $doctrine ): Response
    {
       
        return $this->render('admin/unvalitdate.html.twig', [
          
        ]);
    }
}
