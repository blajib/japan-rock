<?php

namespace App\Controller\Admin;

use App\Entity\DashboardPage;
use App\Entity\GlobalConfiguration;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        // ...set chart data and options somehow

        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
                        ->setTitle('Magik Hiragana')
                        ->setTitle('<img src="..."> ACME <span class="text-small">Corp.</span>')
                        ->setFaviconPath('favicon.svg')
                        ->setTranslationDomain('my-custom-domain')
                        ->setTextDirection('ltr')
                        ->renderContentMaximized()
                        ->renderSidebarMinimized()
                        ->disableDarkMode()
                        ->generateRelativeUrls()
                        ->setLocales(['en', 'pl'])
                        ->setLocales([
                            'en' => '🇬🇧 English',
                            'fr' => 'French',
                        ])
                        ->setLocales([
                            'en', // locale without custom options
                        ])
        ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Pages'),
            MenuItem::linkToCrud("Page d'accueil", 'fa fa-tags', DashboardPage::class)
                    ->setAction('detail')
                    ->setEntityId(1),
            MenuItem::linkToCrud("Paramètres globaux", 'fa fa-tags', GlobalConfiguration::class)
                    ->setAction('detail')
                    ->setEntityId(1),
        ];
    }
}
