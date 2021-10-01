<?php

namespace App\Controller\User;
use App\Form\PasswordEditType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CompteUserController extends AbstractController
{

    #[Route('/moncompte/{id}', name: 'compte_user')]

    public function compte(int $id, UserRepository $userRepository, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $userConnected = $userRepository->find($id);

        if($userConnected !== $this->getUser())
        {
            //Ajouter message flash
            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(PasswordEditType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $userConnected->setPassword(
                $passwordEncoder->encodePassword(
                    $userConnected,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/compte/detail.html.twig', [
            'formPassword' => $form->createView(),
        ]);

        return $this->render("user/compte/detail.html.twig");
    }

    
}