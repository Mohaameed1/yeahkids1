<?php

namespace App\Controller;

use App\Entity\Temperature;
use App\Form\TemperatureType;
use App\Repository\TemperatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/temperature")
 */
class TemperatureController extends AbstractController
{
    /**
     * @Route("/", name="app_temperature_index", methods={"GET"})
     */
    public function index(TemperatureRepository $temperatureRepository): Response
    {
        return $this->render('temperature/index.html.twig', [
            'temperatures' => $temperatureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_temperature_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TemperatureRepository $temperatureRepository): Response
    {
        $temperature = new Temperature();
        $form = $this->createForm(TemperatureType::class, $temperature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $temperatureRepository->add($temperature);
            return $this->redirectToRoute('app_temperature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('temperature/new.html.twig', [
            'temperature' => $temperature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_temperature_show", methods={"GET"})
     */
    public function show(Temperature $temperature): Response
    {
        return $this->render('temperature/show.html.twig', [
            'temperature' => $temperature,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_temperature_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Temperature $temperature, TemperatureRepository $temperatureRepository): Response
    {
        $form = $this->createForm(TemperatureType::class, $temperature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $temperatureRepository->add($temperature);
            return $this->redirectToRoute('app_temperature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('temperature/edit.html.twig', [
            'temperature' => $temperature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_temperature_delete", methods={"POST"})
     */
    public function delete(Request $request, Temperature $temperature, TemperatureRepository $temperatureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$temperature->getId(), $request->request->get('_token'))) {
            $temperatureRepository->remove($temperature);
        }

        return $this->redirectToRoute('app_temperature_index', [], Response::HTTP_SEE_OTHER);
    }
}
