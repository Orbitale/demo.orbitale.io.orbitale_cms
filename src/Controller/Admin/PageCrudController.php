<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\LanguageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\LocaleField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            FormField::addTab('General'),
            TextField::new('title'),
            TextField::new('slug')->setDisabled()->setHelp('Automatically generated/updated'),
            AssociationField::new('category'),
            BooleanField::new('enabled'),
            TextEditorField::new('content'),
        ];

        if ($pageName !== Crud::PAGE_INDEX) {
            $fields = [
                ...$fields,

                FormField::addTab('Meta'),
                TextField::new('metaDescription'),
                TextField::new('metaTitle'),
                TextField::new('metaKeywords'),
                LocaleField::new('locale'),

                FormField::addTab('Styling and interaction'),
                TextareaField::new('css'),
                TextareaField::new('js')->setDisabled()->setHelp('Disabled for obvious reasons 😉'),

                FormField::addTab('Disabled fields (for showcase mostly)'),
                BooleanField::new('homepage')->setDisabled(),
                AssociationField::new('parent')->setRequired(false)->setDisabled(),
                TextField::new('host')->setDisabled(),
            ];
        }

        return $fields;
    }
}
