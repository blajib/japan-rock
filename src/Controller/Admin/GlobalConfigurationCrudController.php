<?php

namespace App\Controller\Admin;

use App\Entity\GlobalConfiguration;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class GlobalConfigurationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GlobalConfiguration::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('background', 'Image de fond')
                      ->setUploadDir('public/assets/uploads')
                      ->setBasePath('assets/uploads'),
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
