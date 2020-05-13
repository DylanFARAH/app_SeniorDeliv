<?php 

namespace src\Controller\Admin ;

use App\Entity\Senior;
use App\Entity\User;
use App\Form\SeniorType;
use App\Repository\SeniorRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminSeniorController extends AbstractController
{
    /**
     * @var SeniorRepository
     */
    private $repository;

    /**
     * @var UserRepository
     */
    private $user_repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;   

    public function __construct(SeniorRepository $repository,UserRepository $user_repository, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $this->repository = $repository ;
        $this->user_repository = $user_repository ;
        $this->em = $em ;
        $this->encoder = $encoder;
    }

    /**
     * @Route ("/admin/senior",name="admin.senior.index")
     * @return Response
     */
    public function index()
    {
        $seniors = $this->repository->findAll();
        return $this->render('admin/senior/index.html.twig', compact('seniors'));
    }

    /**
     * @Route ("/admin/senior/creer", name="admin.senior.new")
     * @param Request $request
     */
    public function new(Request $request)
    {
        $senior = new Senior();
        $form = $this->createForm(SeniorType::class, $senior);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $compte = new User();
            $compte->setUsername($senior->getUsername());
            $compte->setRoles('ROLE_USER');
            $compte->setPassword($this->encoder->encodePassword($compte,$senior->getUsername()));
            $this->em->persist($compte);
            $this->em->flush();

            $senior->setCompte($compte);
            $senior->setActif(true);
            $this->em->persist($senior);
            $this->em->flush();
            $this->addFlash('success', 'Senior créer avec succès');
            return $this->redirectToRoute('admin.senior.index');
        }

        return $this->render('admin/senior/new.html.twig', [
            'senior' => $senior, 
            'form' => $form->createView()
            ]);

    }

    /**
     * @Route ("/admin/senior/{id}",name="admin.senior.edit", methods="GET|POST")
     * @param Senior $senior
     * @param Request $request
     * @return Response
     */
    public function edit(Senior $senior, Request $request)
    {
        $form = $this->createForm(SeniorType::class, $senior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Senior modifier avec succès');
            return $this->redirectToRoute('admin.senior.index');
        }

        return $this->render('admin/senior/edit.html.twig', [
            'senior' => $senior, 
            'form' => $form->createView()
            ]);
    }

    /**
     * @Route ("admin/senior/{id}", name="admin.senior.delete", methods="DELETE")
     * @param Senior $senior
     * @return Response
     */
    public function delete(Senior $senior, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'. $senior->getId(), $request->get('_token')))
        {
            $this->em->remove($senior);
            $this->em->flush();
            $this->addFlash('success', 'Senior supprimer avec succès');
            return $this->redirectToRoute('admin.senior.index');
        }
    }

    /**
     * @Route ("/seniors/{id}",name="admin.senior.show")
     * @param Senior $senior 
     * @return Response
     */
    public function show(Senior $senior, Request $request): Response
    {
        $form = $this->createForm(SeniorType::class, $senior);

        return $this->render('admin/senior/show.html.twig', [
            'senior' => $senior ,
            'form'=> $form->createView()
        ]);
    }


}