<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Domain\Place\Entity\Place;
use App\Domain\Place\Enum\Influx;
use App\Domain\Place\Form\PictureType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

final class PlaceCrudController extends AbstractCrudController
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
            ->setSearchFields(['title', 'types.name', 'city', 'postalCode'])
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('types'))
            ->add('influx')
            ->add('ratings')
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
        $influxChoices = [];
        foreach (Influx::cases() as $influx) {
            $influxChoices[$influx->value] = $influx->name;
        }

        $influxChoicesColors = [];
        foreach (Influx::cases() as $influx) {
            $influxChoicesColors[$influx->name] = $influx->color();
        }

        yield FormField::addPanel('Description');
        yield TextField::new('title');
        yield TextEditorField::new('description')->hideOnIndex();
        yield CollectionField::new('pictures')->setEntryType(PictureType::class)->onlyOnForms();
        yield CollectionField::new('pictures')->setTemplatePath('admin/fields/images.html.twig')->onlyOnDetail();
        yield ChoiceField::new('influx')
            ->setChoices($influxChoices)
            ->renderAsBadges($influxChoicesColors);
        yield AssociationField::new('types')->setFormTypeOption('by_reference', false)->hideOnIndex();
        yield NumberField::new('ratings')->hideOnIndex();

        yield FormField::addPanel('Location');
        yield TextField::new('address');
        yield TextField::new('city');
        yield TextField::new('postalCode')->hideOnIndex();
        yield CountryField::new('country')->hideOnIndex();
        yield NumberField::new('longitude')->setNumDecimals(6)->onlyOnDetail();
        yield NumberField::new('latitude')->setNumDecimals(6)->onlyOnDetail();
    }
}
