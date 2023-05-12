<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Annonces;
use App\Entity\Candidacy;
use App\Form\CandidacyType;
use App\Form\ValidatedAnnonceType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceDeatailController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/annonce/detail/{id}', name: 'app_annonce_detail')]
    public function index(ManagerRegistry $doctrine, $id, Request $request): Response
    {

        $repository = $doctrine->getRepository(Annonces::class);
        $annonce = $repository->find($id);
        

        if (!$annonce) {
            $this->addFlash('error', "L'annonce n'existe pas!");
            return $this->redirectToRoute('app_annonce_liste');
        }

        $isApproved = $this->createForm(ValidatedAnnonceType::class, $annonce);

        $isApproved->remove('job');
        $isApproved->remove('salairy');
        $isApproved->remove('locality');
        $isApproved->remove('schedules');
        $isApproved->remove('recruteur');
        $isApproved->remove('user');
        $isApproved->remove('annonce');

        $isApproved->handleRequest($request);

        if ($isApproved->isSubmitted() && $isApproved->isValid()) {
            $approved = $isApproved->get('isApproved')->getData();

            $annonce->setIsApproved($approved);

            $user = $annonce->getUser();
            $email = $user->getEmail();

            $email = new Mail();
            $email->send(
                $email,
                $user->getFirstName(),
                'Votre annonce à été validé',
                'et mise en ligne '
            );

            $this->entityManager->flush();

            return $this->redirectToRoute('app_annonce_liste');
        }
        $candidacy = new Candidacy;

        // Récupérer l'utilisateur actuellement connecté
        $user = $this->getUser();

        // Associer l'annonce et l'utilisateur à la candidature
        $candidacy->setAnnonce($annonce);
        $candidacy->setUser($user);

        $candidate = $this->createForm(CandidacyType::class, $candidacy);
        $candidate->remove('user');
        $candidate->remove('annonce');

        $candidate->handleRequest($request);

        if ($candidate->isSubmitted() && $candidate->isValid()) {
            // Sauvegarder la candidature en base de données
            $this->entityManager->persist($candidacy);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_account');
        }
        return $this->render('account/annonceDetail.html.twig', [
            'annonce' => $annonce,
            'approved' => $isApproved->createView(),
            'candidate'=> $candidate->createView()
        ]);
    }
}
