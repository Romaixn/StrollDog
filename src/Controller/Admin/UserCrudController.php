<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
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
    }
}
