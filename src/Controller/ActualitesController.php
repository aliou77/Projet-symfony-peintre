<?php

namespace App\Controller;

use App\Entity\BlogPost;
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
            $repo->findBy([], ['id' => 'DESC']),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('actualites/actualites.html.twig', [
            'controller_name' => 'ActualitesController',
            'blogposts' => $blogposts,
            'current_menu' => 'actualites'
        ]);
    }

    #[Route("/post-{slug}-{id}", "actualites.show")]
    public function show(BlogPost $blogPost, string $slug, int $id): Response{
        // si le slug ne correspond pas a celui mis dans l'URL on renvoie vers le bon 
        if(($blogPost->getSlug() !== $slug) || ($blogPost->getId() !== $id)){
            $this->redirectToRoute('actualites.show', [
                'id' => $blogPost->getId(),
                'slug' => $blogPost->getSlug()
            ], 301);
        }
        return $this->render("actualites/show.html.twig", [
            'post' => $blogPost,
        ]);
    }
}
