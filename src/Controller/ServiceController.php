<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/service")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("/", name="service_index", methods={"GET"})
     */
    public function index(ServiceRepository $serviceRepository): Response
    {
        $form = $this->createForm(ServiceType::class);
        $services = $serviceRepository->findAll();
        foreach($services as $service){
            $serviceForm = $this->createForm(ServiceType::class, $service);
            $service->setForm($serviceForm->createView());
        }

        return $this->render('service/index.html.twig', [
            'services' => $serviceRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="service_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();
        }

        $redirectRoute = $request->headers->get('referer');

        if($redirectRoute!==null){
            return $this->redirect($redirectRoute);
        }else{
            return $this->redirectToRoute('service_index');
        }
    }

    /**
     * @Route("/{id}", name="service_show", methods={"GET"})
     */
    public function show(Service $service): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        return $this->render('service/show.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Service $service): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        }

        $redirectRoute = $request->headers->get('referer');

        if($redirectRoute!==null){
            return $this->redirect($redirectRoute);
        }else{
            return $this->redirectToRoute('service_index');
        }
    }

    /**
     * @Route("/{id}", name="service_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Service $service): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('service_index');
    }
}
