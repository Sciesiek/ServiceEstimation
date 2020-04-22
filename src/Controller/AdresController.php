<?php

namespace App\Controller;

use App\Entity\Adres;
use App\Form\AdresType;
use App\Repository\AdresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/adres")
 */
class AdresController extends AbstractController
{
    /**
     * @Route("/", name="adres_index", methods={"GET"})
     */
    public function index(AdresRepository $adresRepository): Response
    {
        $form = $this->createForm(AdresType::class);
        $adres = $adresRepository->findAll();
        foreach($adres as $adre){
            $adresForm = $this->createForm(AdresType::class, $adre);
            $adre->setForm($adresForm->createView());
        }

        return $this->render('adres/index.html.twig', [
            'adres' => $adres,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="adres_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $adre = new Adres();
        $form = $this->createForm(AdresType::class, $adre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adre);
            $entityManager->flush();
        }


        $redirectRoute = $request->headers->get('referer');
        if($redirectRoute!==null){
            return $this->redirect($redirectRoute);
        }else{
            return $this->redirectToRoute('adres_index');
        }
    }

    /**
     * @Route("/{id}", name="adres_show", methods={"GET"})
     */
    public function show(Adres $adre): Response
    {
        $form = $this->createForm(AdresType::class, $adre);
        return $this->render('adres/show.html.twig', [
            'adre' => $adre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="adres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Adres $adre): Response
    {
        $form = $this->createForm(AdresType::class, $adre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        }

        $redirectRoute = $request->headers->get('referer');
        if($redirectRoute!==null){
            return $this->redirect($redirectRoute);
        }else{
            return $this->redirectToRoute('adres_index');
        }
    }

    /**
     * @Route("/{id}", name="adres_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Adres $adre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adres_index');
    }
}
