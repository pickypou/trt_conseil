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

class UserDetailController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('admin/user/detail/{id<\d+>}', name: 'app_admin_user_detail')]
    public function index(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $repository = $doctrine->getRepository(User::class);
        $user = $repository->find($id);
        if (!$user) {
            $this->addFlash('error', "L'utilisateur n'existe pas!");
            return $this->redirectToRoute('app_users_list');

        }
         $role = $this->getUser()->getRoles();
        $addRole = $this->createForm(RoleSelectType::class, $role);
        $addRole->handleRequest($request);
       

        if ($addRole->isSubmitted() && $addRole->isValid()) {
           $newRole = $addRole->get('roles')->getData();
           $user->setRoles([$newRole]);
           $this->entityManager->flush();
        }
       
        return $this->render('admin/userDetail.html.twig',[
            'user'=>$user,
            'role' =>$role,
            'addRole'=>$addRole->createView()
        ]);
    }
}
