<?php

namespace App\Controller;

use App\Entity\Moteur;
use App\Form\MoteurType;
use App\Repository\MoteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/moteur")
 */
class MoteurController extends AbstractController
{
    /**
     * @Route("/", name="app_moteur_index", methods={"GET"})
     */
    public function index(MoteurRepository $moteurRepository): Response
    {
        return $this->render('moteur/index.html.twig', [
            'moteurs' => $moteurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_moteur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MoteurRepository $moteurRepository): Response
    {
        $moteur = new Moteur();
        $form = $this->createForm(MoteurType::class, $moteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moteurRepository->add($moteur);
            return $this->redirectToRoute('app_moteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moteur/new.html.twig', [
            'moteur' => $moteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_moteur_show", methods={"GET"})
     */
    public function show(Moteur $moteur): Response
    {
        return $this->render('moteur/show.html.twig', [
            'moteur' => $moteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_moteur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Moteur $moteur, MoteurRepository $moteurRepository): Response
    {
        $form = $this->createForm(MoteurType::class, $moteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moteurRepository->add($moteur);
            return $this->redirectToRoute('app_moteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moteur/edit.html.twig', [
            'moteur' => $moteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_moteur_delete", methods={"POST"})
     */
    public function delete(Request $request, Moteur $moteur, MoteurRepository $moteurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moteur->getId(), $request->request->get('_token'))) {
            $moteurRepository->remove($moteur);
        }

        return $this->redirectToRoute('app_moteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
