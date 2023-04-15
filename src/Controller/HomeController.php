<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PeintureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    private $repo;
    private $blogRepo;

    public function __construct(PeintureRepository $repo, BlogPostRepository $blogRepo){
        $this->repo = $repo;
        $this->blogRepo = $blogRepo;
    }

    #[Route('/', name: 'app_home')]
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        
        // $peintures = $paginator->paginate(
        //     $this->repo->get3Latest(), 
        //     $request->query->getInt('page', 1), // si ya pa de page currant definit il mettra 1
        //     3
        // );
        // dump($peintures);
        
        $peintures = $this->repo->get3Latest();
        $blogposts = $this->blogRepo->get3Latest();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'peintures' => $peintures,
            'blogposts' => $blogposts,
        ]);
    }
}
