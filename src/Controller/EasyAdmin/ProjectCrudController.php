<?php

namespace App\Controller\EasyAdmin;

use App\Entity\Project;
use App\Form\MediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureActions(Actions $actions): Actions 
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }

    public function configureFields(string $pageName): iterable
    {

        $fields = [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title', 'Titre'),
            TextField::new('client', 'Client'),
            DateTimeField::new('year', 'Date'),
            AssociationField::new('category', 'Catégorie'),
            TextEditorField::new('description', 'Description')->hideOnIndex(),
            BooleanField::new('active', 'Actif'),    
            DateTimeField::new('createdAt')->onlyOnDetail(),
            DateTimeField::new('updatedAt')->onlyOnDetail(),

            FormField::addPanel('Photos'),
        ];

        if($pageName == "detail") {
            $fields[]= CollectionField::new('media', '')
                        ->onlyOnDetail()
                        ->setTemplatePath("medias.html.twig");

        } elseif($pageName == "edit") {
            $fields[]= CollectionField::new('media', 'Photos')
                        ->setEntryType(MediaType::class)
                        ->onlyOnForms();

        }

        return $fields;
    }
}
