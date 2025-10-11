<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController extends AbstractController
{
    #[Route('/', name: 'landing_page')]
    public function index(): Response
    {
        return $this->render('pages/calendar.html.twig');
    }

    #[Route('/login', name: 'login_page')]
    public function login(): Response
    {
        return $this->render('pages/login.html.twig');
    }

    #[Route('/admin', name: 'admin_page')]
    public function admin(): Response
    {
        return $this->render('layouts/dashbord.html.twig');
    }
}