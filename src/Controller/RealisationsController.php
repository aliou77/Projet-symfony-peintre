<?php

namespace App\Controller;

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
}
