<?php

namespace App\Controller;

use App\Form\AccountType;
use App\Entity\Particulier;
use App\Entity\Professionnel;
use App\Form\ModifproFormType;
use App\Form\RegisproFormType;
use App\Form\ModifpartFormType;
use App\Form\RegispartFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
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
            // $user->setRoles(["ROLE_ADMIN"]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute("app_login");

        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/registerpro", name="app_registerpro")
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
            // $user->setRoles(["ROLE_ADMIN"]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute("app_loginpro");

        }

        return $this->render('registration/registerpro.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/registration/register", name="modifParticulier")        //Route juste ?
     */
    public function modifierParticulier(Request $request, ObjectManager $manager){
        
        $user=$this->getUser();
        $form=$this->createForm(ModifpartFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('pageAccueil', ['id' => $user->getID()]);
        }

        return $this->render('registration/modifParticulier.html.twig', ['registrationForm' => $form->createView()]);
    }

    /**
     * @Route("/registration/registerpro", name="modifProfessionnel")       //Route juste ?
     */
    public function modifierUserPro(Request $request, ObjectManager $manager){
        
        $user=$this->getUserPro();
        $form=$this->createForm(ModifproFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('pageAccueil', ['id' => $user->getID()]);
        }

        return $this->render('registration/modifProfessionnel.html.twig', ['registrationForm' => $form->createView()]);
    }

}
