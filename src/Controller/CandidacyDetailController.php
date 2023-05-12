<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Candidacy;
use App\Form\ValidatedCandidacyType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidacyDetailController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/candidacy/detail/{id}', name: 'app_candidacy_detail')]
    public function index(ManagerRegistry $doctrine,$id, Request $request): Response
    {
        $repository = $doctrine->getRepository(Candidacy::class);
        $candidacy= $repository->find($id);
        

        if (!$candidacy) {
            $this->addFlash('error', "L'annonce n'existe pas! vous ne pouvé pas candidaté");
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
            $email = $user->getEmail();

            $email = new Mail();
            $email->send(
                $email,
                $user->getFirstName(),
                'Votre candidature à été validé',
                'vous allez étre mis en relation avec le restaurant '
            );

              // Récupérer l'utilisateur et son adresse e-mail
              $user = $candidacy->getUser();
              $userEmail = $user->getEmail();
  
              // Envoyer un e-mail à l'utilisateur
              $userMail = new Mail();
              $userMail->send(
                  $userEmail,
                  $user->getFirstName(),
                  'Votre candidature a été validée',
                  'Vous allez être mis en relation avec le restaurant.'
              );
  
              // Envoyer un e-mail au recruteur
              $recruiterEmail = $candidacy->getAnnonce()->getUser()->getEmail();
              $recruiterMail = new Mail();
              $recruiterMail->send(
                  $recruiterEmail,
                  'Recruteur',
                  'Nouvelle candidature reçue',
                  'Une nouvelle candidature a été approuvée pour votre annonce.'
              );

            $this->entityManager->flush();

             return $this->redirectToRoute('app_unvalidated_candidacy');
        }
           
        return $this->render('admin/candidacyDetail.html.twig', [
            'approved' => $isApproved->createView(),
            'candidacy'=>$candidacy
        ]);
    }
}
