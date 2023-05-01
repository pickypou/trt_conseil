<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnonceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoncesController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
      $this->entityManager = $entityManager;
    }

    #[Route('/annonces', name: 'app_annonces')]
    public function index(Request $request): Response
    {
        $annonce = new Annonces();
        $form = $this->createForm(AnnonceType::class,$annonce);
        $form->remove('recruteur');

        $form->handleRequest($request);
        return $this->render('account/deposerAnnonce.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
