<?php

namespace App\Controller;

use App\Entity\Chantier;
use App\Form\ChantierType;
use App\Repository\ChantierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chantiers")
 */
class ChantierController extends AbstractController
{
    /**
     * @Route("/", name="liste_chantiers", methods={"GET"})
     */
    public function index(ChantierRepository $chantierRepository): Response
    {
        return $this->render('chantier/index.html.twig', [
            'chantiers' => $chantierRepository->findAllWithDetails(),
        ]);
    }

    /**
     * @Route("/nouveau", name="nouveau_chantier", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chantier = new Chantier();
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chantier);
            $entityManager->flush();

            return $this->redirectToRoute('liste_chantiers');
        }

        return $this->render('chantier/new.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/editer", name="editer_chantier", methods={"GET","POST"})
     */
    public function edit(Request $request, Chantier $chantier): Response
    {
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('liste_chantiers');
        }

        return $this->render('chantier/edit.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="supprimer_chantier", methods={"DELETE"})
     */
    public function delete(Request $request, Chantier $chantier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chantier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chantier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('liste_chantiers');
    }
}
