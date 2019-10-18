<?php

namespace App\Controller;


use App\Entity\Particulier;
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
     * @Route("/vues/afficherParticulier/{id}", name="afficherParticulier")
     */
    public function afficherParticulier(Particulier $particulier, ObjectManager $manager, Request $request) {

        return $this->render('vues/afficherParticulier.html.twig', [
            'utilisateur' => $particulier
        ]);
    }

}

