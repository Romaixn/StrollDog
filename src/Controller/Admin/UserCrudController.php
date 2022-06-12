<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Domain\Security\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['name', 'username', 'email'])
            ->setDefaultSort(['updatedAt' => 'ASC', 'createdAt' => 'ASC'])
            ->setDateTimeFormat(DateTimeField::FORMAT_MEDIUM, DateTimeField::FORMAT_SHORT);
    }

    public function configureFields(string $pageName): iterable
    {
        yield BooleanField::new('isVerified');
        yield ChoiceField::new('roles')->setChoices([
            'Administrator' => 'ROLE_ADMIN',
            'User' => 'ROLE_USER',
        ])->renderAsBadges(true)->hideOnForm();
        yield TextField::new('name');
        yield TextField::new('username');
        yield EmailField::new('email');
        yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex();
        yield ImageField::new('image')->setBasePath($this->getParameter('app.path.user_images'))->onlyOnDetail();
        yield DateTimeField::new('createdAt')->setDisabled(true)->onlyOnDetail();
        yield DateTimeField::new('updatedAt')->setDisabled(true)->onlyOnDetail();
    }
}
