<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use App\Repository\CategoryRepository;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{


    #[Route('/sitemap', name: 'app_sitemap', format: "xml")]
    public function index(Request $request,
        PeintureRepository $repo_peinture, 
        CategoryRepository $repo_cat,
        BlogPostRepository $repo_blog
        ): Response
    {
        $urls = [];
        $hostname = $request->getSchemeAndHttpHost();
        $urls[] = ['loc' => $this->generateUrl("app_home")];
        $urls[] = ['loc' => $this->generateUrl("app_realisations")];
        $urls[] = ['loc' => $this->generateUrl("app_actualites")];
        $urls[] = ['loc' => $this->generateUrl("portfolio")];
        $urls[] = ['loc' => $this->generateUrl("apropos")];

        foreach ($repo_peinture->findAll() as $e) {
            $urls[] = [
                'loc' => $this->generateUrl("realisation.show", [
                            'id' => $e->getId(),
                            'slug' => $e->getSlug(),
                ]),
                "lastmod" => $e->getDateRealisation()->format('Y-m-d')
            ];
        }
        foreach ($repo_cat->findAll() as $e) {
            $urls[] = [
                'loc' => $this->generateUrl("portfolio_category", [
                            'id' => $e->getId(),
                            'slug' => $e->getSlug(),
                ]),
                
            ];
        }
        foreach ($repo_blog->findAll() as $e) {
            $urls[] = [
                'loc' => $this->generateUrl("actualites.show", [
                            'id' => $e->getId(),
                            'slug' => $e->getSlug(),
                ]),
                "lastmod" => $e->getCreatedAt()->format('Y-m-d')
            ];
        }
        // renvoyer la vue pour le xml
        return  new Response(
                $this->renderView('sitemap/sitemap.html.twig', [
                    'urls' => $urls,
                    'hostname' => $hostname
                ])
            , 200, ['content-type' => 'text/xml']);
    }

}
