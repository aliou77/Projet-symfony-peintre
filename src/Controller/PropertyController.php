<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    #[Route("/old", "home")]
    public function index(){
        return $this->render('property/index.html.twig');
    }
    
}
