<?php

namespace App\Controller;

use App\Entity\Peinture;
use App\Repository\PeintureRepository;
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
            $repo->findAll(),
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
    public function show(Peinture $peinture): Response{
        // dump($peinture->getCategory()[0]); recupere la category lier a la peinture
        return $this->render("realisations/show.html.twig", [
            'realisation' => $peinture, // on recupere directement la peinture qui aura ete selection et qui se trouve dans cette route
        ]);
    }
}