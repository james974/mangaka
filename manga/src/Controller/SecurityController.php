<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


/**
 * @Route("/signup", name="app_signup")
 */

 public function signup(Request $request): Response
 {
$user = new User();
/* $user ->setEmail('Email');
$user ->setPassword('mot de passe'); */

$form = $this->createForm(UserType::class, $user);

/* $form= $this->createFormBuilder($user)
    ->add ('Email', TextType::class)
    ->add ('Email', PasswordType::class)
    ->add ('save', SubmitType::class, ['label' => 'Créer un utilisateur'])
    ->getForm(); */
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()){
        dump($user);die;
    }  
    return $this->render('security/login.html.twig',[
        'form' => $form->createView()
    ]);
 }
}
