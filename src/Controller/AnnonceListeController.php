<?php

namespace App\Controller;

use App\Entity\Annonces;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceListeController extends AbstractController
{
    #[Route('/annonce/liste', name: 'app_annonce_liste')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Annonces::class);
        $annonces = $repository->findAll();


        return $this->render('account/annoncesListe.html.twig',[
            'annonces'=>$annonces
        ]);

    }
}
