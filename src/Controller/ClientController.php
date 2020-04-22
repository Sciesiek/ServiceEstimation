<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Adres;
use App\Entity\Estimate;
use App\Form\ClientType;
use App\Form\AdresType;
use App\Form\EstimateType;
use App\Repository\ClientRepository;
use App\Repository\AdresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="client_index", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository): Response
    {
        $form = $this->createForm(ClientType::class);
        $clients = $clientRepository->findAll();
        foreach($clients as $client){
            $clientForm = $this->createForm(ClientType::class, $client);
            $client->setForm($clientForm->createView());
        }

        return $this->render('client/index.html.twig', [
            'clients' => $clients,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="client_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
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
     * @Route("/{id}", name="client_show", methods={"GET"})
     */
    public function show(Client $client): Response
    {
        $adreses = $this->getDoctrine()
        ->getRepository(Adres::class)
        ->findBy(['client' => $client]);

        foreach($adreses as $adres){
            $adresForm = $this->createForm(AdresType::class, $adres);
            $adres->setForm($adresForm->createView());
        }

        $form = $this->createForm(ClientType::class, $client);

        $estimates = $this->getDoctrine()
        ->getRepository(Estimate::class)
        ->findBy(['client' => $client]);

        foreach($estimates as $estimate){
            $estimateForm = $this->createForm(EstimateType::class, $estimate);
            $estimate->setForm($estimateForm->createView());
        }

        return $this->render('client/show.html.twig', [
            'client' => $client,
            'adres' => $adreses,
            'estimates' => $estimates,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Client $client): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        }

        $redirectRoute = $request->headers->get('referer');

        if($redirectRoute!==null){
            return $this->redirect($redirectRoute);
        }else{
            return $this->redirectToRoute('client_index');
        }
    }

    /**
     * @Route("/{id}", name="client_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Client $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('client_index');
    }
}
