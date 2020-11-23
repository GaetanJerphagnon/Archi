<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Category;
use App\Entity\Media;
use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/easyadmin", name="easyadmin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Architecte');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Projets', 'fa fa-pencil-ruler', Project::class);
        yield MenuItem::linkToCrud('Catégories', 'fa fa-list-ol', Category::class);
        yield MenuItem::section('Mediathèque WIP');
        // yield MenuItem::linkToCrud('Images', 'fa fa-photo', Media::class);

    }
}
