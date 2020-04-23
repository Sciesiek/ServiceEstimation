<?php

namespace App\Controller;

use App\Entity\EstimateService;
use App\Form\EstimateServiceType;
use App\Repository\EstimateServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/estimate_service")
 */
class EstimateServiceController extends AbstractController
{

    /**
     * @Route("/new", name="estimate_service_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $estimateService = new EstimateService();
        $form = $this->createForm(EstimateServiceType::class, $estimateService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estimateService);
            $entityManager->flush();
        }

        $redirectRoute = $request->headers->get('referer');

        if($redirectRoute!==null){
            return $this->redirect($redirectRoute);
        }else{
            return $this->redirectToRoute('client_index');
        }
    }

    /**
     * @Route("/{id}/edit", name="estimate_service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EstimateService $estimateService): Response
    {
        $form = $this->createForm(EstimateServiceType::class, $estimateService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estimate_service_index');
        }

        $redirectRoute = $request->headers->get('referer');

        if($redirectRoute!==null){
            return $this->redirect($redirectRoute);
        }else{
            return $this->redirectToRoute('client_index');
        }
    }

    /**
     * @Route("/{id}", name="estimate_service_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EstimateService $estimateService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estimateService->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estimateService);
            $entityManager->flush();
        }

        $redirectRoute = $request->headers->get('referer');

        if($redirectRoute!==null){
            return $this->redirect($redirectRoute);
        }else{
            return $this->redirectToRoute('client_index');
        }
    }
}
