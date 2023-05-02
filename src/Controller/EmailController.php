<?php

namespace App\Controller;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class EmailController extends AbstractController
{
    private MailerService $mailerService;
    public function __construct(MailerService $mailerService)
    {
        $this->mailerService = $mailerService;
    }
        
    
   
    public function index(MailerService $mail): Response
    {
        $this->mailerService->sendEmail();
        return new Response('Email sent successfully!');
    }
}
