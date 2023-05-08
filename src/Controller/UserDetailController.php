<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\User;
use App\Form\RoleSelectType;
use App\Service\MailerService;
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
    public function index(Request $request, ManagerRegistry $doctrine, $id, MailerService $mailer): Response
    {
        $repository = $doctrine->getRepository(User::class);
        $user = $repository->find($id);
        if (!$user) {
            $this->addFlash('error', "L'utilisateur n'existe pas!");
            return $this->redirectToRoute('app_users_list');
        }
        $candidatRepository = $this->entityManager->getRepository(Candidat::class);
        $candidat = $candidatRepository->findOneBy(['user'=>$user]);
         $role = $this->getUser()->getRoles();
        $addRole = $this->createForm(RoleSelectType::class, $role);
        $addRole->handleRequest($request);
       

        if ($addRole->isSubmitted() && $addRole->isValid()) {
           $newRole = $addRole->get('roles')->getData();
           $user->setRoles([$newRole]);
           $this->entityManager->flush();
              // Envoyer un email de confirmation à l'utilisateur validé
        $mailer->sendEmail($user);
           return $this->redirectToRoute('app_users_list');
        
        }
        $isApproved = $this->createForm(ValidatedAccountType::class,$user);

        $isApproved->remove('email');
        $isApproved->remove('password');
        $isApproved->remove('firstname');
        $isApproved->remove('lastname');
        $isApproved->remove('roles');
        $isApproved->remove('candidat');

        $isApproved->handleRequest($request);
      

        if ($isApproved->isSubmitted() && $isApproved->isValid()) {
           $approved = $isApproved->get('isApproved')->getData();

           $user->setIsApproved($approved);

          
           
            $this->entityManager->flush();
            return $this->redirectToRoute('app_unvalidated_user');
        }
       
        return $this->render('admin/userDetail.html.twig',[
            'user'=>$user,
            'role' =>$role,
            'candidat'=>$candidat,
            'addRole'=>$addRole->createView(),
            'approved'=> $isApproved->createView()
        ]);
    }
}
