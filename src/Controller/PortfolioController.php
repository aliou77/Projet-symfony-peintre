<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController {

    #[Route("/portfolio", name: "portfolio")]
    public function apropos(): Response{

        return $this->render("portfolio/portfolio.html.twig", [
            'controllerName' => 'PortfolioController',
            'current_menu' => 'portfolio'
        ]);
    }
}