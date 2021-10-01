<?php

namespace App\Controller\User;

use App\Repository\ArticleRepository;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index_rec(RecetteRepository $recetteRepository, ArticleRepository $articleRepository): Response
    {
        $recettes= $recetteRepository->findBy(
            [], 
            ['date'=> 'DESC'], 
            3
        );

        $articles = $articleRepository->findBy(
            [], 
            ['date'=> 'DESC'], 
            3
        );
        
        return $this->render('home/home.html.twig', [
            'recettes' => $recettes,
            'articles' => $articles
        ]);

        

        
    }


}
