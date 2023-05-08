<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WaitingForApprovalController extends AbstractController
{
    #[Route('/waiting/for/approval', name: 'app_waiting_for_approval')]
    public function index(): Response
    {
        return $this->render('waiting_for_approval/index.html.twig', [
            'controller_name' => 'WaitingForApprovalController',
        ]);
    }
}
