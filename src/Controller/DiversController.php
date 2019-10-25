<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\CaracTech;
use App\Entity\Particulier;
use App\Form\ImagesFormType;
use App\Form\CaracTechFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DiversController extends AbstractController{

    /**
     * @Route("/", name="page_accueil")
     */
    public function pageAccueil(){
        return $this->render("pagedaccueil.html.twig");
    }

    /**
     * @Route("/vues/afficherParticulier/{id}", name="afficher_part")
     */
    public function afficherParticulier(Particulier $particulier, ObjectManager $manager, Request $request) {

        return $this->render('vues/afficherpart.html.twig', [
            'utilisateur' => $particulier
        ]);
    }

    /**
     * @Route("/admin/ajouterCarac", name="ajouter_carac")
     * @IsGranted("ROLE_ADMIN")
     */
    public function ajouterCaracTech(Request $request)
    {
        $carac = new CaracTech();
        $form = $this->createForm(CaracTechFormType::class, $carac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $carac = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carac);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute("liste_caracs");

        }

        return $this->render('admin/ajoutercarac.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/listeCaracs", name="liste_caracs")
     */
    public function listeCaracTech() {

        $caracs = $this->getDoctrine()->getRepository(CaracTech::class)->findAll();

        return $this->render('/admin/listecaracs.html.twig', ['caracs' => $caracs]);
    }

    /**
     * @Route("/admin/modifCarac/{id}", name="modif_carac")
     */
    public function modifierCarac(CaracTech $carac, Request $request, ObjectManager $manager)
    {
        $form=$this->createForm(CaracTechFormType::class, $carac);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($carac);
            $manager->flush();

            return $this->redirectToRoute('liste_caracs');
        }

        return $this->render('admin/ajoutercarac.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/supprCarac/{id}", name="suppr_carac")
     */
    public function supprCarac(CaracTech $carac, ObjectManager $manager) {

        $manager->remove($carac);
        $manager->flush();
  
        return $this->redirectToRoute('liste_caracs');
    }

    /**
     * @Route("/admin/ajouterImage", name="ajouter_image")
     * @IsGranted("ROLE_ADMIN")
     */
    public function ajouterImage(Request $request)
    {
        $image = new Images();
        $form = $this->createForm(ImagesFormType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute("liste_images");

        }

        return $this->render('admin/ajouterimage.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/listeImages", name="liste_images")
     */
    public function listeImages() {

        $images = $this->getDoctrine()->getRepository(Images::class)->findAll();

        return $this->render('/admin/listeimages.html.twig', ['images' => $images]);
    }

    /**
     * @Route("/admin/supprImage/{id}", name="suppr_image")
     */
    public function supprImage(Images $image, ObjectManager $manager) {

        $manager->remove($image);
        $manager->flush();
  
        return $this->redirectToRoute('liste_images');
    }


}



