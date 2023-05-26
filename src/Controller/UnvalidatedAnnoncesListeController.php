<?php

namespace App\Controller;

use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnvalidatedAnnoncesListeController extends AbstractController
{
    #[Route('/unvalidated/annonces/liste', name: 'app_unvalidated_annonces_liste')]
    public function index(AnnoncesRepository $annoncesRepository): Response
    {
        $unvalidatedAnnonces = $annoncesRepository->findUnvalidatedAnnonces();

        return $this->render('admin/unvalidatedAnnonces.html.twig', [
            'annonces' => $unvalidatedAnnonces,
           
        ]);
    }
}
