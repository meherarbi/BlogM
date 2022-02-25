<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Repository\CarouselRepository;



class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $articleRepository ,CarouselRepository $carouselRepository): Response
    {
        $articles = $articleRepository->findArticle();
        $carousel = $carouselRepository->findBy(['isDisplayed'=>true]);
        
        
        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'carousel' => $carousel,
            
        ]);
    }
    

  

    #[Route('/article/{slug}', name: 'show')]
    public function show(ArticleRepository $articleRepository , $slug): Response
    {
        $article = $articleRepository->findOneBySlug($slug);
        if(!$article){
            return $this->redirectToRoute('home');
        }
        
        return $this->render('show/index.html.twig', [
            'article' => $article,
        ]);
    }
}
