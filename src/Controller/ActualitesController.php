<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualitesController extends AbstractController
{
    #[Route('/actualites', name: 'app_actualites')]
    public function actualites(
        BlogPostRepository $repo,
        PaginatorInterface $pagination,
        Request $request
    ): Response {

        $blogposts = $pagination->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('actualites/actualites.html.twig', [
            'controller_name' => 'ActualitesController',
            'blogposts' => $blogposts,
            'current_menu' => 'actualites'
        ]);
    }
}
