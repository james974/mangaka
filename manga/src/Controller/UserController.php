<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class UserController extends AbstractController
{

/**
 * @Route("/signup", name="app_signup")
 */

 public function signup(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder): Response
 {
$user = new User();
/*$user ->setEmail('Email');
$user ->setPassword('mot de passe'); */

$form = $this->createForm(UserType::class, $user);

/* $form= $this->createFormBuilder($user)
    ->add ('Email', TextType::class)
    ->add ('Email', PasswordType::class)
    ->add ('save', SubmitType::class, ['label' => 'Créer un utilisateur'])
    ->getForm(); */
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()){
        $user->setPassword(
            $passwordEncoder ->encodePassword(
                $user,
                $form->get('password')->getData()
            )
        );
            
        
        $entityManager->persist($user);
        $entityManager->flush();
    }  
    return $this->render('inscription/index.html.twig',[
        'form' => $form->createView()
    ]);
 }
}
