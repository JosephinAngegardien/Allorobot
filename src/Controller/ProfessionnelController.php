<?php

namespace App\Controller;

use App\Entity\Professionnel;
use App\Form\ModifproFormType;
use App\Form\RegisproFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfessionnelController extends AbstractController
{
    /**
     * @Route("/professionnel/registerpro", name="inscription_pro")
     */
    public function registerpro(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Professionnel();
        $form = $this->createForm(RegisproFormType::class, $user);      //On relie les champs du formulaire aux champs de l'utilisateur.
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setRoles(["ROLE_PROFESSIONNEL"]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute("connexion_pro");

        }

        return $this->render('professionnel/registerpro.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/professionnel/login", name="connexion_pro")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('professionnel/loginpro.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/professionnel/logout", name="deco_pro")
     * 
     * @return void
     */
    public function logout(){}

    /**
     * @Route("/professionnel/modifpro", name="modif_pro")
     */
    public function modifierProfessionnel(Request $request, ObjectManager $manager){
        
        $user=$this->getUser();
        $form=$this->createForm(ModifproFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('accueil_pro', ['id' => $user->getID()]);
        }

        return $this->render('professionnel/modifpro.html.twig', ['registrationForm' => $form->createView()]);
    }

    /**
     * @Route("/professionnel/accueilpro", name="accueil_pro")
     */
    public function accueilPro(){
        return $this->render("professionnel/accueilpro.html.twig");
    }

}


