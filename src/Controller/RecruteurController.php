<?php

namespace App\Controller;

use App\Entity\Recruteur;
use App\Form\RecruteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecruteurController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/recruteur', name: 'app_recruteur')]
    public function index(Request $request): Response
    {
        $recruteur =  new Recruteur();

        $form = $this->createForm(RecruteurType::class, $recruteur);
        $form->remove('user');

        $user = $this->getUser();
        $recruteur->setUser($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recruteur = $form->getData();
            $companyName = $recruteur->getCompanyname();
            $recruteur->setCompanyname($companyName);

            $this->entityManager->persist($recruteur);
            $this->entityManager->flush();
        }
        return $this->render('account/recruteur.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
