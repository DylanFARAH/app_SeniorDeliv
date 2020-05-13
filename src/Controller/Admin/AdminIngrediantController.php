<?php

namespace src\Controller\Admin;

use App\Entity\Ingrediant;
use App\Form\IngrediantType;
use App\Repository\IngrediantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ingrediant")
 */
class AdminIngrediantController extends AbstractController
{
    /**
     * @Route("/", name="admin.ingrediant.index", methods={"GET"})
     */
    public function index(IngrediantRepository $ingrediantRepository): Response
    {
        return $this->render('admin/ingrediant/index.html.twig', [
            'ingrediants' => $ingrediantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.ingrediant.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ingrediant = new Ingrediant();
        $form = $this->createForm(IngrediantType::class, $ingrediant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ingrediant);
            $entityManager->flush();

            return $this->redirectToRoute('admin.ingrediant.index');
        }

        return $this->render('admin/ingrediant/new.html.twig', [
            'ingrediant' => $ingrediant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.ingrediant.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ingrediant $ingrediant): Response
    {
        $form = $this->createForm(IngrediantType::class, $ingrediant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.ingrediant.index');
        }

        return $this->render('admin/ingrediant/edit.html.twig', [
            'ingrediant' => $ingrediant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.ingrediant.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ingrediant $ingrediant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingrediant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ingrediant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.ingrediant.index');
    }
}
