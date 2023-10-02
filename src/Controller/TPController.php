<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TPController extends AbstractController
{
    #[Route('/tp', name: 'app_tp')]
    public function index(): Response
    {
        return $this->render('tp/index.html.twig', [
            'controller_name' => 'TPController',
        ]);
    }
}
