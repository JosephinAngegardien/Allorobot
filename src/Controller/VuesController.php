<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class VuesController extends AbstractController{

    /**
     * @Route("/", name="pageAccueil")
     */
    public function pageAccueil(){
        return $this->render("pagedaccueil.html.twig");
    }


}

