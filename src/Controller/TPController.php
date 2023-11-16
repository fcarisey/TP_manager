<?php

namespace App\Controller;

use App\Entity\TP;
use App\Form\TPType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TPRepository;

class TPController extends AbstractController
{
    private EntityManagerInterface $em;
    private TPRepository $rep;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->em = $entityManager;
        $this->rep = $entityManager->getRepository(TP::class);
    }

    #[Route('/tp', name: 'app_tp')]
    public function index(): Response
    {
        return $this->render('tp/index.html.twig', [
            'controller_name' => 'TPController',
        ]);
    }

    #[Route('/tp/create', name: 'create_tp')]
    public function create(Request $req) : Response
    {
        $tp = new TP();

        $form = $this->createForm(TPType::class);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()){
            $this->rep->save($tp, true);
            $this->redirectToRoute('app_tp');
        }

        return $this->render('tp/create.html.twig',[
            'form' => $form,
        ]);
    }
}
