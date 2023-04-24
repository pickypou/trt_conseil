<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RoleSelectType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoleSelectController extends AbstractController
{  private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    
    #[Route('/admin/add/role/{id<\d+>}', name: 'app_add_role')]

    public function addRoles(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $role = $this->getUser()->getRoles();
        $repository = $doctrine->getRepository(User::class);
        $user = $repository->find($id);
        if (!$user) {
           
            return $this->redirectToRoute('app_users_list');

        }

        $addRole = $this->createForm(RoleSelectType::class, $role);
        $addRole->handleRequest($request);

        if ($addRole->isSubmitted() && $addRole->isValid()) {
           $newRole = $addRole->get('roles')->getData();
           $user->setRoles([$newRole]);
           $this->entityManager->flush();
        }

        return $this->render('admin/roleSelect.html.twig', [      
          'addRole'=>$addRole->createView()
        ]);
    }
}
