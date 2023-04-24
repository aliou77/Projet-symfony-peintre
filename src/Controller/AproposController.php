<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AproposController extends AbstractController {

    #[Route("/apropos", name: "apropos")]
    public function apropos(UserRepository $repo): Response{

        return $this->render("apropos/apropos.html.twig", [
            'controllerName' => 'AproposController',
            'current_menu' => 'apropos',
            'user' => $repo->getPeintre(),
        ]);
    }
}