<?php

namespace App\Controller;

use App\Entity\Candidacy;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidacyListController extends AbstractController
{
    #[Route('/candidacy/list', name: 'app_candidacy_list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Candidacy::class);
        $candidacys = $repository->findAll();
        return $this->render('admin/candidacyList.html.twig', [
            'candidacys' => $candidacys,
        ]);
    }
}
