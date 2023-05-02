<?php
namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Recruteur;
use App\Form\AnnonceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

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
        $form = $this->createForm(AnnonceType::class, $annonce);
        
        // Supprime le champ "recruteur" du formulaire pour que l'utilisateur ne puisse pas le modifier.
        $form->remove('recruteur');
    
       $user = $this->getUser();
       $annonce->setUser($user);

       
        
        // Gère la soumission du formulaire.
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $annonce = $form->getData();
            $annonceName = $annonce->getAnnonce();
            $annonce->setAnnonce($annonceName);
    
            $this->entityManager->persist($annonce);
            $this->entityManager->flush();
          
            
            return $this->redirectToRoute('app_account');
        }
    
        return $this->render('account/deposerAnnonce.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
