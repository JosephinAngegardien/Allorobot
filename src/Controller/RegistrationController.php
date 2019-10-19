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
     * @Route("/registerpart", name="inscription_part")
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

            return $this->redirectToRoute("connexion_part");

        }

        return $this->render('particulier/registerpart.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/registerpro", name="inscription_pro")
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

            return $this->redirectToRoute("connexion_pro");

        }

        return $this->render('professionnel/registerpro.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

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

}
