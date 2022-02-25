<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class ArticleCrudController extends AbstractCrudController
{
    public const ARTICLE_BASE_PATH= 'uploads/' ;
    public const ARTICLE_UPLOAD_DIR= 'public/uploads/' ;
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            SlugField::new('slug')->setTargetFieldName('titre'),
            ImageField::new('image')
                ->setBasePath(self::ARTICLE_BASE_PATH)
                ->setUploadDir(self::ARTICLE_UPLOAD_DIR)
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired( false),
            TextEditorField::new('sousTitre'),
            TextEditorField::new('description'),
            DateTimeField::new('createdAt')->hideOnForm(),
            
        ];
    }
    public function persistEntity(EntityManagerInterface $em , $entityInstance):void
    {
        if (!$entityInstance instanceof Article) return ;
        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        parent::persistEntity($em, $entityInstance);
    }
    
}
