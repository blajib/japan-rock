<?php

namespace App\Controller\Admin;

use App\Entity\DashboardPage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DashboardPageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DashboardPage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('title'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::INDEX)
        ;
    }
}
