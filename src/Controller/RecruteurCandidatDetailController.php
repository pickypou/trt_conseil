<?php

namespace App\Controller;

use App\Entity\Candidacy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecruteurCandidatDetailController extends AbstractController
{
    #[Route('/recruteur/candidat/detail', name: 'app_recruteur_candidat_detail')]
    public function index(Candidacy $candidacy): Response
    {
         // Vérifier si la candidature appartient au recruteur actuellement connecté
         $user = $this->getUser();
         $recruteur = $user->getRecruteur();
 
         if (!$recruteur || !$recruteur->hasCandidacy($candidacy)) {
             $this->addFlash('error', "Vous n'avez pas accès à cette candidature.");
             return $this->redirectToRoute('app_recruteur_candidatures');
         }
 
        return $this->render('account/recruteurCandidatDetail.html.twig', [
            'candidat' => $candidacy,
        ]);
    }
}
