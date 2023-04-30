<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\PeintureRepository;
use App\Service\ServiceCommentaire;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RealisationsController extends AbstractController
{
    #[Route('/realisations', name: 'app_realisations')]
    public function realisations(
        PeintureRepository $repo,
        PaginatorInterface $paginator,
        Request $request
        ): Response {

        $realisations = $paginator->paginate(
            $repo->findBy([], ['id' => 'DESC']),
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('realisations/realisations.html.twig', [
            'controller_name' => 'RealisationsController',
            'realisations' => $realisations,
            'current_menu' => "realisations"
        ]);
    }

    #[Route("/peinture-{slug}-{id}", "realisation.show")]
    public function show(Peinture $peinture, string $slug, int $id, Request $request, 
        ServiceCommentaire $serv, CommentaireRepository $repo
        ): Response
    {
        // si le slug ne correspond pas a celui mis dans l'URL on renvoie vers le bon 

        if(($peinture->getSlug() !== $slug) || ($peinture->getId() !== $id)){
            $this->redirectToRoute('realisation.show', [
                'id' => $peinture->getId(),
                'slug' => $peinture->getSlug()
            ], 301);
        }
        
        $commentaires = $repo->findCommentaires($peinture);
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $data = $form->getData();
            $serv->persistCommentaire($data, $peinture, null);
            $this->addFlash("success", "Votre commentaire a été posté, il sera publié apres validation !");

            $this->redirectToRoute('realisation.show', [
                'id' => $id,
                'slug' => $slug
            ]);
        };

        // dump($peinture->getCategory()[0]); recupere la category lier a la peinture
        return $this->render("realisations/show.html.twig", [
            'realisation' => $peinture, // on recupere directement la peinture qui aura ete selection et qui se trouve dans cette route
            'form' => $form->createView(),
            'commentaires' => $commentaires, 
        ]);
    }
}