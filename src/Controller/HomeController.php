<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PeintureRepository;

class HomeController extends AbstractController
{
    private $repo;
    private $blogRepo;

    public function __construct(PeintureRepository $repo, BlogPostRepository $blogRepo){
        $this->repo = $repo;
        $this->blogRepo = $blogRepo;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'peintures' => $this->repo->get3Latest(),
            'blogposts' => $this->blogRepo->get3Latest(),
        ]);
    }
}
