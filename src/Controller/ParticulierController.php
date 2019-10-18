<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ParticulierController extends AbstractController
{
    /**
     * @Route("/particulier/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('particulier/login.html.twig', ['last_username' => $lastUsername, 'error' => $error,]);
    }

    /**
     * @Route("/particulier/logout", name="part_logout")
     * 
     * @return void
     */
    public function logout(){}

    /**
     * @Route("/particulier/accueilpart", name="accueil_part")
     */
    public function accueilPart(){
        return $this->render("particulier/accueilpart.html.twig");
    }

}


