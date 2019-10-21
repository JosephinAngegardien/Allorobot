<?php

namespace App\Controller;

use App\Entity\Administrateur;
use App\Form\RegisadminFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/registeradmin", name="inscription_admin")
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Administrateur();
        $form = $this->createForm(RegisadminFormType::class, $user);      //On relie les champs du formulaire aux champs de l'utilisateur.
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setRoles(["ROLE_ADMIN"]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute("connexion_admin");

        }

        return $this->render('admin/registeradmin.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @route("/admin/login", name="connexion_admin")
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render("admin/loginadmin.html.twig", ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/admin/logout", name="deco_admin")
     * 
     * @return void
     */
    public function logout(){}

    /**
     * @Route("/admin/accueiladmin", name="accueil_admin")
     */
    public function accueilAdmin(){
        return $this->render("admin/accueiladmin.html.twig");
    }


}


