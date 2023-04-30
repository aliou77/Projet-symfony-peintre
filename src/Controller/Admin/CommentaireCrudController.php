<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class; 
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new("peinture"),
            AssociationField::new("blogpost"),
            TextField::new('autheur'),
            TextField::new('email'),
            TextareaField::new('contenu'),
            DateTimeField::new("createdAt", "date de creation"),
            BooleanField::new("isPublished", "publié"),
        ];
    }

    // cette methode permet de modifier la configuration du CRUD de EasyAdmin
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // modification de lorsdre d'affichage des blogpostes 
            ->setDefaultSort(['id' => 'DESC'])
            ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL) // ajout un button pour acceder aux details
            ->disable(Action::DELETE, Action::NEW) // desactive les actions delete et ajout
            ;
    }

}
