<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @route("/admin", name="app_admin")
     * 
     * @return Response
     */
    public function admin()
    {
        return $this->render("vues/admin.html.twig");
    }

    /**
     * @Route("/admin/logout", name="admin_logout")
     * 
     * @return void
     */
    public function logout(){}

}


