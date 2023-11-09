<?php

namespace App\Controller;

use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(UtilisateurType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur');
        }

        return $this->render('utilisateur/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/utilisateur/search', name: 'app_utilisateur_search')]
    public function search(Request $request): string
    {
        $s = $request->query->get('s');

        if (is_null($s))
            return json_encode(['error' => 'Paramètre de recherche manquant']);

        $s_exploded = explode(' ', $s);

//        // find user from nom, prenom
//        (new UtilisateurRepository)->findBy()
//        $users = $this->getDoctrine()->getRepository('App:Utilisateur')->findByNomPrenom($s_exploded);
//        if (count($users) > 0)
//            return json_encode($users);
//
//        return json_encode(['error' => 'Aucun utilisateur trouvé']);


    }
}
