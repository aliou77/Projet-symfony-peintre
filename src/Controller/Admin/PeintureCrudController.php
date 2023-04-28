<?php

namespace App\Controller\Admin;

use App\Entity\Peinture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PeintureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Peinture::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextEditorField::new('description')->hideOnIndex(),
            NumberField::new("longueur")->hideOnIndex(),
            NumberField::new("largeur")->hideOnIndex(),
            NumberField::new("prix"),
            DateField::new("dateRealisation"),
            DateField::new("datePublication")->hideOnIndex(),
            BooleanField::new("enVente"),
            BooleanField::new("portfolio")->hideOnIndex(),
            TextField::new("imageFile")->setFormType(VichImageType::class)->onlyWhenCreating(),
            ImageField::new("image")->setBasePath('/images/peinture')->onlyOnIndex(), // c'est dans ce chemin que sera uploader les images
            SlugField::new("slug")->setTargetFieldName('nom')->hideOnIndex(), // permet d'autoremplir le slug grace au nom de la peinture
            AssociationField::new('category'),
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
}
