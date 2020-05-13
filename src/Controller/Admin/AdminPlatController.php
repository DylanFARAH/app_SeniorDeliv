<?php 

namespace src\Controller\Admin ;

use App\Entity\Plat;
use App\Entity\Ingrediant;
use App\Form\PlatType;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AdminPlatController extends AbstractController
{
    /**
     * @var PlatRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PlatRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository ;
        $this->em = $em ;
    }

    /**
     * @Route ("/admin",name="admin.plat.index")
     * @return Response
     */
    public function index()
    {
        $plats = $this->repository->findAll();
        return $this->render('admin/plat/index.html.twig', compact('plats'));
    }

    /**
     * @Route ("/admin/plat/creer", name="admin.plat.new")
     * @param Request $request
     */
    public function new(Request $request)
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($plat);
            $this->em->flush();
            $this->addFlash('success', 'Plat créer avec succès');
            return $this->redirectToRoute('admin.plat.index');
        }

        return $this->render('admin/plat/new.html.twig', [
            'plat' => $plat, 
            'form' => $form->createView()
            ]);

    }

    /**
     * @Route ("/admin/plat/{id}",name="admin.plat.edit", methods="GET|POST")
     * @param Plat $plat
     * @param Request $request
     * @return Response
     */
    public function edit(Plat $plat, Request $request)
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Plat modifier avec succès');
            return $this->redirectToRoute('admin.plat.index');
        }

        return $this->render('admin/plat/edit.html.twig', [
            'plat' => $plat, 
            'form' => $form->createView()
            ]);
    }

    /**
     * @Route ("admin/plat/{id}", name="admin.plat.delete", methods="DELETE")
     * @param Plat $plat
     * @return Response
     */
    public function delete(Plat $plat, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'. $plat->getId(), $request->get('_token')))
        {
            $this->em->remove($plat);
            
            $this->em->flush();
            $this->addFlash('success', 'Plat supprimer avec succès');
            return $this->redirectToRoute('admin.plat.index');
        }
    }


}