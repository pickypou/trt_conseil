<?php

namespace App\Controller;

use App\Repository\CandidacyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnvalidatedCandidacyController extends AbstractController
{
    #[Route('/unvalidated/candidacy', name: 'app_unvalidated_candidacy')]
    public function index(CandidacyRepository $candidacyRepository): Response
    {

        $unvalidatedCandidacy = $candidacyRepository->findUnvalidatedCandidacy();
        return $this->render('admin/unvalidatedCandidacy.html.twig', [
            'candidacys' =>  $unvalidatedCandidacy,
        ]);
    }
}
