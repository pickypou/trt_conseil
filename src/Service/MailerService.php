<?php

namespace App\Service;

use App\Entity\Candidat;
use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;

class MailerService
{
    private $mailer;
    private $cvDirectory;


    public function __construct(MailerInterface $mailer, string $cvDirectory)
    {
        $this->mailer = $mailer;
        $this->cvDirectory = $cvDirectory;
    }

    public function sendCandidacyEmail(
        string $to,
        string $content = '<p>nouvelle candidature</p>',
        Candidat $user,
        string $host,
    ): void {

        $cvFilePath = "http://" . $host . "/uploads/cv/" . $user->getCv();

        

        $email = (new Email())
            ->from('spysschaert.ludo@gmail.com')
            ->to($to)
            ->replyTo('spysschaert.ludo@gmail.com')

            ->html($content . "<a href=\"" . $cvFilePath . "\">CV</a>");


        $this->mailer->send($email);
    }
}
