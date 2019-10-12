<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserPro;
use App\Form\AccountType;
use App\Form\RegisproFormType;
use App\Form\ModifUserFormType;
use App\Form\RegistrationFormType;
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
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);      //On relie les champs du formulaire aux champs de l'utilisateur.
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setRoles(["ROLE_USER"]);
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
        $user = new UserPro();
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
            $user->setRoles(["ROLE_USERPRO"]);
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
     * @Route("/registration/register", name="modifUser")
     */
    public function modifierUser(Request $request, ObjectManager $manager){
        
        $user=$this->getUser();
        $form=$this->createForm(ModifUserFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('pageAccueil', ['id' => $user->getID()]);
        }

        return $this->render('registration/modifuser.html.twig', ['registrationForm' => $form->createView()]);
    }

    /**
     * @Route("/registration/registerpro", name="modifUserpro")
     */
    public function modifierUserPro(Request $request, ObjectManager $manager){
        
        $user=$this->getUserPro();
        $form=$this->createForm(ModifUserProFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('pageAccueil', ['id' => $user->getID()]);
        }

        return $this->render('registration/modifuserpro.html.twig', ['registrationForm' => $form->createView()]);
    }

}
