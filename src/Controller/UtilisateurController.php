<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager, UtilisateurRepository $utilisateurRepository, ValidatorInterface $validator): Response
    {
        $users = $utilisateurRepository->findAll();

        $form_create = $this->createForm(UtilisateurType::class);

        $form_create->handleRequest($request);
        if ($form_create->isSubmitted() && $form_create->isValid()) {
            $utilisateur = $form_create->getData();

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur');
        }

        $form_edit = $this->createForm(UtilisateurType::class);

        $form_edit->handleRequest($request);
        if ($form_edit->isSubmitted() && $form_edit->isValid()) {
            $utilisateur = $form_edit->getData();

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur');
        }

        return $this->render('utilisateur/index.html.twig', [
            'form_create' => $form_create,
            'form_edit' => $form_edit,
            'users' => $users,
        ]);
    }

    #[Route('/utilisateur/search', name: 'app_utilisateur_search', methods: 'GET')]
    public function search(Request $request, UtilisateurRepository $utilisateurRepository): Response
    {
        $s = $request->query->get('s');

        if (is_null($s))
            return $this->json(['error' => 'Paramètre de recherche manquant'], 400);

        $s_exploded = explode(' ', $s);

        $query = $utilisateurRepository->createQueryBuilder('u')
            ->orderBy('u.nom', 'ASC')
            ->addOrderBy('u.prenom', 'ASC');

        foreach ($s_exploded as $s_exploded_item) {
            $query->orWhere('u.nom LIKE :s_exploded_item')
                ->orWhere('u.prenom LIKE :s_exploded_item')
                ->setParameter('s_exploded_item', '%' . $s_exploded_item . '%');
        }

        $utilisateurs = $query->getQuery()->execute();

        $json = $this->container->get('serializer')->serialize($utilisateurs, 'json',[
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
            'groups' => [
                'utilisateur',
                'utilisateur_classe',
                'classe',
            ]
        ]);

        return new JsonResponse($json, json: true);
    }

    #[Route('/utilisateur/{id}', name: 'utilisateur.delete', methods: 'DELETE')]
    public function delete(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response{
        $entityManager->remove($utilisateur);
        $entityManager->flush();

        return $this->redirect($request->server->get('HTTP_REFERER'));
    }
}
