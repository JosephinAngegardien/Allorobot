<?php

namespace App\Controller;

use App\Entity\Robots;
use App\Form\RobotsFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RobotsController extends AbstractController
{
    /**
     * @Route("/robots/liste", name="liste_robots")
     */
    public function index()
    {
        return $this->render('robots/liste.html.twig', [
            'controller_name' => 'RobotsController',
        ]);
    }

    /**
     * @Route("/admin/creerrobot", name="creer_robot")
     * @IsGranted("ROLE_ADMIN")
     */
    public function create(Request $request, ObjectManager $manager): Response
    {
        $robot = new Robots();
        $form = $this->createForm(RobotsFormType::class, $robot);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            foreach($robot->getImages() as $image) {
                $image->setAd($robot);
                $manager->persist($image);
            }

            $manager->persist($robot);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le modèle {$robot->getModele()} a bien été enregistré !"
            );

            return $this->redirectToRoute('modele_robot');
        }

        return $this->render('admin/creerrobot.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher un seul robot
     *
     * @Route("/robots/modele", name="modele_robot")
     * 
     * @return Response
     */
    public function show(Robots $robot){
        return $this->render('robots/voirmodele.html.twig', [
            'robot' => $robot
        ]);
    }

}
