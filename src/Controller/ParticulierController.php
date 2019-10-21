<?php

namespace App\Controller;

use App\Entity\Particulier;
use App\Form\ModifpartFormType;
use App\Form\RegispartFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParticulierController extends AbstractController
{
    /**
     * @Route("/particulier/registerpart", name="inscription_part")
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Particulier();
        $form = $this->createForm(RegispartFormType::class, $user);      //On relie les champs du formulaire aux champs de l'utilisateur.
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setRoles(["ROLE_PARTICULIER"]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute("connexion_part");

        }

        return $this->render('particulier/registerpart.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/particulier/login", name="connexion_part")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('particulier/loginpart.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/particulier/logout", name="deco_part")
     * 
     * @return void
     */
    public function logout(){}

    /**
     * @Route("/particulier/modifpart", name="modif_part")
     */
    public function modifierParticulier(Request $request, ObjectManager $manager){
        
        $user=$this->getUser();
        $form=$this->createForm(ModifpartFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('accueil_part', ['id' => $user->getID()]);
        }

        return $this->render('particulier/modifpart.html.twig', ['registrationForm' => $form->createView()]);
    }

    /**
     * @Route("/particulier/accueilpart", name="accueil_part")
     */
    public function accueilPart(){
        return $this->render("particulier/accueilpart.html.twig");
    }

}


