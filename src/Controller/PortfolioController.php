<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\returnSelf;

class PortfolioController extends AbstractController {

    #[Route("/portfolio", name: "portfolio")]
    public function apropos(CategoryRepository $repo): Response{

        return $this->render("portfolio/portfolio.html.twig", [
            'controllerName' => 'PortfolioController',
            'current_menu' => 'portfolio',
            'categories' => $repo->findAll()
        ]);
    }

    #[Route("/category-{slug}-{id}", name: "portfolio_category", requirements: ['slug' => '[a-z0-9\-]*'])]
    public function peintures(Category $cat, PeintureRepository $repo): Response {

        return $this->render("portfolio/categories.html.twig", [
            'peintures' => $repo->findAllPortfolio($cat),
            'category' => $cat
        ]);
    }
}