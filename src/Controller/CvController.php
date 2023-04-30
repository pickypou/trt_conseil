<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Form\FormCvType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CvController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/cv', name: 'app_cv')]
    public function index(Request $request, SluggerInterface $slugger, ManagerRegistry $doctrine): Response
    {
        $curriculum = $request->getSession();
        $curriculum = new Candidat();
      
       
       

        $form = $this->createForm(FormCvType::class,$curriculum);
        $form->remove('user');
        $form->handleRequest($request);

        $user = $this->getUser();
        $curriculum->setUser($user);
        
        if ($form->isSubmitted() && $form->isValid()) {
           $curriculumFile = $form->get('curriculum')->getData();
           if ($curriculumFile) {
            $originalFilename = pathinfo($curriculumFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$curriculumFile->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $curriculumFile->move(
                    $this->getParameter('brochures_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }


        $curriculum->setCv($newFilename);
        $this->entityManager->persist($curriculum);
            $this->entityManager->flush();
    }
    return $this->redirectToRoute('app_account');
}
       
        
        return $this->render('account/deposercv.html.twig', [
           'form'=>$form->createView()
        ]);
    }
}
