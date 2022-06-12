<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Domain\Place\Entity\Place;
use App\Domain\Place\Entity\Type;
use App\Domain\Security\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin', options: ['expose' => true])]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('StrollDog');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fas fa-tachometer-alt');
        yield MenuItem::linkToRoute('Go to site', 'fas fa-home', 'home');

        yield MenuItem::section('Places');
        yield MenuItem::linkToCrud('Places', 'fas fa-map-marker-alt', Place::class);
        yield MenuItem::linkToCrud('Types', 'fas fa-tags', Type::class);

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
    }
}
