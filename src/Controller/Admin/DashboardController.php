<?php

namespace App\Controller\Admin;

use App\Entity\BlogPost;
use App\Entity\Category;
use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        return $this->render("admin/dashboard.html.twig");

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Art-peintre');
    }

    public function configureMenuItems(): iterable
    {
        // represente le menu a gauche du dashboard
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Actualités', 'fas fa-newspaper', BlogPost::class);
        yield MenuItem::linkToCrud('Peintures', 'fas fa-palette', Peinture::class);
        yield MenuItem::linkToCrud('Profile', 'fa fa-user', User::class);
        // yield MenuItem::linkToCrud('Commentaires', 'fas fa-list', Commentaire::class);
    }
}
