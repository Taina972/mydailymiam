<?php

namespace App\Controller\User;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManager;
use App\MesServices\ImageService;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleUserController extends AbstractController




{
    #[Route('/liste/article/user', name: 'article_user')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('user/article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    #[Route('/detail/article/{id}', name: 'article_user_show', methods: ['GET', 'POST'])]
    public function show(int $id, Article $article, Request $request, EntityManagerInterface $em): Response
 
    {

        $commentaire = new Commentaire();
        
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form -> handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $commentaire->setArticle($article);
            $commentaire->setAuteur($this->getUser());

            $em->persist($commentaire);
            $em->flush();

            return $this->redirectToRoute('article_user', ['id' => $id]);
        
        }

        return $this->render('user/article/show.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }
}