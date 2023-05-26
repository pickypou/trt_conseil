<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin');
        }
        if ( $this->isGranted('ROLE_CONSULTANT')) {
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
