<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main_index')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    #[Route('/contact', name: 'app_main_contact')]
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig');
    }
}
