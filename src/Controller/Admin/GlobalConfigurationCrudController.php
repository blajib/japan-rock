<?php

namespace App\Controller\Admin;

use App\Api\WeatherApi;
use App\Entity\GlobalConfiguration;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class GlobalConfigurationCrudController extends AbstractCrudController
{
    public function __construct(protected WeatherApi $weatherApi)
    {
    }
    public static function getEntityFqcn(): string
    {
        return GlobalConfiguration::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            ImageField::new('background', 'Image de fond')
                ->setUploadDir('public/uploads')
                ->setBasePath('uploads'),
        ];



        if (null !== $this->weatherApi->getWeather('tokyo')) {
            $fields[] = TextField::new('weatherApiId', 'Id API https://api.openweathermap.org');
        } else {
            $fields[] = TextField::new('weatherApiId', "Id API https://api.openweathermap.org (l'id n'est pas correct)")->setFormTypeOption('attr', ['class' => 'text-danger']);
        };

        return $fields;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::INDEX);
    }
}
