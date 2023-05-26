<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Candidacy;
use App\Entity\Candidat;
use App\Entity\Recruteur;
use App\Entity\User;
use App\Form\ValidatedCandidacyType;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CandidacyDetailController extends AbstractController
{
    private $entityManager;
    private $logger;
    private $requestStack;
    private $urlGenerator;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger, RequestStack $requestStack, UrlGeneratorInterface $urlGenerator)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->logger = $logger;
        $this->urlGenerator = $urlGenerator;
    }

    #[Route('/candidacy/detail/{id}', name: 'app_candidacy_detail')]
    public function index(ManagerRegistry $doctrine, $id, Request $request, MailerService $mailer): Response
    {
        $user = $doctrine->getRepository(User::class);
       
        $repository = $doctrine->getRepository(Candidacy::class);
        $candidacy = $repository->find($id);

        if (!$candidacy) {
            $this->addFlash('error', "L'annonce n'existe pas ! Vous ne pouvez pas candidater.");
            return $this->redirectToRoute('app_candidacy_list');
        }

        $isApproved = $this->createForm(ValidatedCandidacyType::class, $candidacy);
        $isApproved->remove('user');
        $isApproved->remove('annonce');
        $isApproved->handleRequest($request);

        if ($isApproved->isSubmitted() && $isApproved->isValid()) {
            $approved = $isApproved->get('isApproved')->getData();
            $candidacy->setIsApproved($approved);
            $user = $candidacy->getUser();
            
          
            $recruteur = $doctrine->getRepository(Recruteur::class);
           // dd($recruteur);
            $mailRecutuer = new Mail();
            $mailRecutuer->mailUserCandidacy(
              //RECUPERE LE CV DU CANDIDAT
               $candidat = $candidacy->getUser(),
            //dd($candidat),
            $candidatPostule = $candidat->getCandidat(),
             // Récupérer le nom du fichier PDF du CV de l'utilisateur
             
             $cvCandidat = $candidatPostule->getCv(),
            
             // Envoyer un e-mail au recruteur avecl URL du CV 
            // Récupérer l'annonce associée à la candidature
           
            $request = $this->requestStack->getCurrentRequest(),
            $host = $request->getSchemeAndHttpHost(),
            $cvUrl = $host . '/uploads/cv/' . $cvCandidat,
           
          $recruteur = $candidacy->getAnnonce()->getRecruteur(),
         // dd($recruteur),
          $recruteurEmail = $recruteur->getUser()->getEmail(),
         //dd($recruteurEmail),
          $this->logger->info("Envoi mail à " . $recruteurEmail . " avec le fichier " . $cvCandidat . " " . $cvUrl),
        );

          // Envoyer un e-mail de confirmation au candidat
          $mailUser = new Mail();
          $mailUser->mailUserValidated(
              $user->getEmail(),
              $user->getFirstName(),
            //  dd($user),
              'Votre candidature a été validée',
              'Vous allez être mis en relation avec le recruteur.'
          );

        
          
           
          
            $this->entityManager->flush();

            return $this->redirectToRoute('app_unvalidated_candidacy');
        }

        // ...

        return $this->render('admin/candidacyDetail.html.twig', [
            'approved' => $isApproved->createView(),
            'candidacy' => $candidacy
        ]);
    }
}
