<?php

namespace App\Controller\Admin;

use App\Entity\Carousel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField ;

class CarouselCrudController extends AbstractCrudController
{
    public const ARTICLE_BASE_PATH= 'uploads/' ;
    public const ARTICLE_UPLOAD_DIR= 'public/uploads/' ;
    public static function getEntityFqcn(): string
    {
        return Carousel::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('image')
                ->setBasePath(self::ARTICLE_BASE_PATH)
                ->setUploadDir(self::ARTICLE_UPLOAD_DIR)
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired( false),
            BooleanField::new('isDisplayed','Display')    
        ];
    }
    
}
