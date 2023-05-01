<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnonceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoncesController extends AbstractController
{
    #[Route('/annonces', name: 'app_annonces')]
    public function index(): Response
    {
        $annonce = new Annonces();
        $form = $this->createForm(AnnonceType::class,$annonce);

        return $this->render('account/deposerAnnonce.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
