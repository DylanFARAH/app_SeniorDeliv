<?php 

namespace src\Controller\User ;

use App\Entity\User;
use App\Entity\Ingrediant;
use App\Entity\Senior;
use App\Form\SeniorType2;
use App\Form\UserType2;
use App\Repository\SeniorRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserCompteController extends AbstractController
{
    /**
     * @var PlatRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;
    
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;  

    public function __construct(UserRepository $repository, EntityManagerInterface $em,UserPasswordEncoderInterface $encoder)
    {
        $this->repository = $repository ;
        $this->em = $em ;
        $this->encoder = $encoder;
    }

    /**
     * @Route ("/user/compte",name="user.compte.index")
     * @return Response
     */
    public function index()
    {
        return $this->render('user/compte/index.html.twig');
    }

    /**
     * @Route ("/user/compte/{id}",name="user.compte.edit", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function edit(Senior $senior, Request $request)
    {
        $form = $this->createForm(SeniorType2::class, $senior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash('success', 'Vos informations ont étes modifiées avec succès');
            return $this->redirectToRoute('user.compte.index');
        }

        return $this->render('user/compte/edit.html.twig', [
            'senior' => $senior, 
            'form' => $form->createView()
            ]);
    }

    /**
     * @Route ("/user/compte/mdp/{id}",name="user.compte.mdp", methods="GET|POST")
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function editMDP(User $user, Request $request)
    {
        $form = $this->createForm(UserType2::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            var_dump($user->getPassword());
            $user->setPassword($this->encoder->encodePassword($user,$user->getPassword()));
            $this->em->flush();
            $this->addFlash('success', 'Votre mot de passe a été modifié avec succès');
            return $this->redirectToRoute('user.compte.index');
        }

        return $this->render('user/compte/edit.mdp.html.twig', [
            'user' => $user, 
            'form' => $form->createView()
            ]);
    }




}