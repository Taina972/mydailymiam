<?php

namespace App\Controller\User;

use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecetteUserController extends AbstractController
{
    #[Route('/liste/recette/user', name: 'recette_user', methods: ['GET'])]
    public function index(RecetteRepository $recetteRepository): Response
    {
        return $this->render('user/recette/index.html.twig', [
            'recettes' => $recetteRepository->findAll(),
        ]);
    }

    #[Route('/detail/recette/{id}', name: 'recette_user_show', methods: ['GET'])]
    public function show(Recette $recette): Response
    {
        return $this->render('user/recette/show.html.twig', [
            'recette' => $recette,
        ]);
    }
}
