<?php

namespace App\Controller;


use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class VuesController extends AbstractController{

    /**
     * @Route("/", name="pageAccueil")
     */
    public function pageAccueil(){
        return $this->render("pagedaccueil.html.twig");
    }

    /**
     * @Route("/vues/afficherUser/{id}", name="afficherUser")
     */
    public function afficherUser(User $user, ObjectManager $manager, Request $request) {

        return $this->render('vues/afficherUser.html.twig', [
            'utilisateur' => $user
        ]);
    }

}

