<?php

namespace App\Controller\Admin;

use App\Entity\Place;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlaceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Place::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Place')
            ->setEntityLabelInPlural('Places')
            ->setSearchFields(['title', 'types.name'])
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('types'))
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addPanel('Description');
        yield TextField::new('title');
        yield TextEditorField::new('description')->hideOnIndex();
        yield ChoiceField::new('influx')->setChoices([
            'Peu de monde' => 'low',
            'Beaucoup de monde' => 'High',
        ])->hideOnIndex();
        yield AssociationField::new('types')->setFormTypeOption('by_reference', false)->hideOnIndex();
        yield NumberField::new('ratings')->hideOnIndex();

        yield FormField::addPanel('Location');
        yield TextField::new('address');
        yield TextField::new('city');
        yield TextField::new('postalCode')->hideOnIndex();
        yield CountryField::new('country')->hideOnIndex();
        yield TextField::new('longitude')->onlyOnDetail();
        yield TextField::new('latitude')->onlyOnDetail();
    }
}
