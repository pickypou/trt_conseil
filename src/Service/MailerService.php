<?php
// src/Service/MailerService.php
namespace App\Service;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private MailerInterface $mailer;
    private ManagerRegistry $doctrine;

    public function __construct(MailerInterface $mailer, ManagerRegistry $doctrine)
    {
        $this->mailer = $mailer;
        $this->doctrine = $doctrine;
    }

    public function sendEmail(User $user): void
    {
        $email = (new Email())
            ->from('your-email@example.com')
            ->to($user->getEmail())
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);

        // ...
    }
}
