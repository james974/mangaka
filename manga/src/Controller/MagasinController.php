<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MagasinController extends AbstractController
{
    /**
     * @Route("/magasin", name="magasin")
     */
    public function index(): Response
    {
        // magasin -> add Manga('nom manga')
        return $this->render('magasin/index.html.twig', [
            'controller_name' => 'MagasinController',
        ]);
    }
}
