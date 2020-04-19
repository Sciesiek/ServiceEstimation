<?php

namespace App\Controller;

use App\Entity\Estimate;
use App\Form\EstimateType;
use App\Repository\EstimateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/estimate")
 */
class EstimateController extends AbstractController
{
    /**
     * @Route("/", name="estimate_index", methods={"GET"})
     */
    public function index(EstimateRepository $estimateRepository): Response
    {
        return $this->render('estimate/index.html.twig', [
            'estimates' => $estimateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="estimate_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $estimate = new Estimate();
        $form = $this->createForm(EstimateType::class, $estimate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estimate);
            $entityManager->flush();

            return $this->redirectToRoute('estimate_index');
        }

        return $this->render('estimate/new.html.twig', [
            'estimate' => $estimate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estimate_show", methods={"GET"})
     */
    public function show(Estimate $estimate): Response
    {
        return $this->render('estimate/show.html.twig', [
            'estimate' => $estimate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="estimate_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Estimate $estimate): Response
    {
        $form = $this->createForm(EstimateType::class, $estimate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estimate_index');
        }

        return $this->render('estimate/edit.html.twig', [
            'estimate' => $estimate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estimate_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Estimate $estimate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estimate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estimate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('estimate_index');
    }
}
