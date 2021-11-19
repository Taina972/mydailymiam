<?php

namespace App\Controller\Admin;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\MesServices\ImageService;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/recette')]
class RecetteController extends AbstractController
{
    #[Route('/', name: 'recette_index', methods: ['GET'])]
    public function index(RecetteRepository $recetteRepository): Response
    {
        return $this->render('admin/recette/index.html.twig', [
            'recettes' => $recetteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'recette_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImageService $imageService): Response
    {
        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image_upload')->getData();

                if($file)
                {
                    $imageService->saveImage($file, $recette);
                }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recette);
            $entityManager->flush();

            return $this->redirectToRoute('recette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/recette/new.html.twig', [
            'recette' => $recette,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'recette_show', methods: ['GET'])]
    public function show(Recette $recette): Response
    {
        return $this->render('admin/recette/show.html.twig', [
            'recette' => $recette,
        ]);
    }

    #[Route('/{id}/edit', name: 'recette_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recette $recette, ImageService $imageService): Response
    {
        $ancienneImage = $recette->getImage();

        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image_upload')->getData();

            if($file)
            {
                $imageService->saveImage($recette,$file);
            }

            if($ancienneImage)
            {
                $imageService->deleteImage($ancienneImage);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/recette/edit.html.twig', [
            'recette' => $recette,
            'form' => $form,
        ]);
    }

    #[Route('/delete/recette/{id}', name: 'recette_delete', methods: ['POST'])]
    public function delete(Request $request, Recette $recette, ImageService $imageService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recette->getId(), $request->request->get('_token'))) {
            $imageService->deleteImage($recette->getImage());
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recette_index', [], Response::HTTP_SEE_OTHER);
    }
}
