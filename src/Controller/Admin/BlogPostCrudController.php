<?php

namespace App\Controller\Admin;

use App\Entity\BlogPost;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BlogPostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogPost::class;
    }

    /* cette methode nous permet de modifier les champs a affichier dans le formulaire de EasyAdmin
        et aussi dans le dashboad et aussi dans l'edite */
    // cette methode permet de modifier la configuration des Champs de EasyAdmin
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // new() recois le nom de la property de la class BlogPost
            TextField::new('titre'),
            TextField::new('slug')->hideOnForm(), // n'affichera pas le champs slug dans les formulaire just dans le dashboard
            // TextEditorField::new('contenu'),
            TextareaField::new('contenu'),
            DateTimeField::new('createdAt')->hideOnForm()
        ];
    }
    
    // cette methode permet de modifier la configuration du CRUD de EasyAdmin
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // modification de lorsdre d'affichage des blogpostes 
            ->setDefaultSort(['createdAt', 'DESC'])
            ;
    }
}
