<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Entity\Article ;
use App\Entity\Carousel ;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud ;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ){

    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        

      
         $url = $this->adminUrlGenerator->setController(ArticleCrudController::class)
                                        ->generateUrl();
        return $this->redirect($url);

       
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BlogMeher');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Blog');
        yield MenuItem::subMenu('Articles','fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Ajouter un Article','fas fa-plus', Article::class )->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('voir Articles','fas fa-eye', Article::class )
        ]);
        yield MenuItem::linkToCrud('Home Slider','fas fa-images', Carousel::class );
    }
}
