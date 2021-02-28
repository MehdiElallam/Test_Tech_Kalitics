<?php

namespace App\Controller;

use App\Entity\Pointage;
use App\Form\PointageType;
use App\Repository\UserRepository;
use App\Repository\PointageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/pointages")
 */
class PointageController extends AbstractController
{

    /**
     * @Route("/", name="liste_pointages", methods={"GET"})
     */
    public function index(PointageRepository $pointageRepository): Response
    {
        // dd($pointageRepository->findAllWithDetails());
        return $this->render('pointage/index.html.twig', [
            'pointages' => $pointageRepository->findAllWithDetails(),
        ]);
    }

    /**
     * @Route("/nouveau", name="nouveau_pointage", methods={"GET","POST"})
     */
    public function new(Request $request , UserRepository $userRepository): Response
    {
        
        $pointage = new Pointage();

        $form = $this->createForm(PointageType::class, $pointage);
        $form->handleRequest($request);

        // dd($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $pointage = $request->request->get('pointage')['user']
            $entityManager = $this->getDoctrine()->getManager();
            // $pointage->addUser($request->request->get('pointage')['user']);
            // dd($pointage);
            $entityManager->persist($pointage);
            $entityManager->flush();

            return $this->redirectToRoute('liste_pointages');
        }

        return $this->render('pointage/new.html.twig', [
            'pointage' => $pointage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/editer", name="editer_pointage", methods={"GET","POST"})
     */
    public function edit(Request $request, Pointage $pointage): Response
    {
        $form = $this->createForm(PointageType::class, $pointage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('liste_pointages');
        }

        return $this->render('pointage/edit.html.twig', [
            'pointage' => $pointage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="supprimer_pointage", methods={"DELETE"})
     */
    public function delete(Request $request, Pointage $pointage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pointage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pointage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('liste_pointages');
    }

    /**
     * @Route("/verifier/{id}", name="verifier_employe", methods={"GET"})
     */
    public function verifierEmploye($id , PointageRepository $pointageRepository)
    {
        $pointageAjourd = $pointageRepository->EmployeePointe($id);

        $response = $this->json(
            array(
                "dejaPointe" => count($pointageAjourd),
            ), 200, []
        );
        
        return $response;
    }
}
