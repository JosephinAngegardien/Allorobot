<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ProfessionnelController extends AbstractController
{
    /**
     * @Route("/professionnel/loginpro", name="connexion_pro")
     */
    public function loginpro(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('professionnel/loginpro.html.twig', ['last_username' => $lastUsername, 'error' => $error,]);
    }

    /**
     * @Route("/professionnel/logout", name="deco_pro")
     * 
     * @return void
     */
    public function logout(){}

    /**
     * @Route("/professionnel/accueilpro", name="accueil_pro")
     */
    public function accueilPro(){
        return $this->render("professionnel/accueilpro.html.twig");
    }

}


