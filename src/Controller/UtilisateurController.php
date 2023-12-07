<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\TPType;
use App\Form\UtilisateurType;
use App\Repository\ClasseRepository;
use App\Repository\TpRepository;
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
    #[Route('/utilisateur', name: 'app_utilisateur', methods: ['GET', 'POST', 'PATCH'])]
    public function index(Request $request, EntityManagerInterface $entityManager, UtilisateurRepository $utilisateurRepository, TpRepository $tpRepository ,ValidatorInterface $validator): Response
    {
        $users = $utilisateurRepository->findAll();

        $form_user_create = $this->createForm(UtilisateurType::class);

        $form_user_create->handleRequest($request);
        if ($form_user_create->isSubmitted() && $form_user_create->isValid()) {
            $utilisateur = $form_user_create->getData();

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur');
        }

        $form_user_edit = $this->createForm(UtilisateurType::class, null ,[
            'method' => 'PATCH',
            'attr' => [
                'name' => "utilisateurEdit"
            ]
        ]);

        $form_user_edit->handleRequest($request);

        if ($form_user_edit->isSubmitted() && $form_user_edit->isValid()) {
            $utilisateur = $form_user_edit->getData();

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur');
        }

        $form_tp_create = $this->createForm(TPType::class);

        $form_tp_create->handleRequest($request);
        if ($form_tp_create->isSubmitted() && $form_tp_create->isValid()) {
            $tp = $form_tp_create->getData();

            $entityManager->persist($tp);
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur');
        }

        $form_tp_edit = $this->createForm(TPType::class, null ,[
            'method' => 'PATCH',
            'attr' => [
                'name' => "tpEdit"
            ]
        ]);

        $form_tp_edit->handleRequest($request);

        if ($form_tp_edit->isSubmitted() && $form_tp_edit->isValid()) {
            $tp = $form_tp_edit->getData();

            $entityManager->persist($tp);
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur');
        }

        return $this->render('utilisateur/index.html.twig', [
            'form_user_create' => $form_user_create,
            'form_user_edit' => $form_user_edit,
            'form_tp_create' => $form_tp_create,
            'form_tp_edit' => $form_tp_edit,
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

    #[Route('/utilisateur/search/tp', name: 'app_utilisateur_tp_search', methods: 'GET')]
    public function searchTp(Request $request, TpRepository $tpRepository, ClasseRepository $classRepository): Response
    {
        $s = $request->query->get('classe_id');

        if (is_null($s))
            return $this->json(['error' => 'Paramètre de recherche manquant'], 400);

        $query = $tpRepository->createQueryBuilder('t')
            ->orderBy('t.date_debut', 'ASC')
            ->where('t.classe = :id')
            ->setParameter('id', $s);

        $tps = $query->getQuery()->execute();

        $json = $this->container->get('serializer')->serialize($tps, 'json',[
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
            'groups' => [
                'tp',
                'tp_classe',
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
