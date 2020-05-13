<?php 

namespace src\Controller\User ;

use App\Entity\Plat;
use App\Entity\Commande;
use App\Entity\User;
use App\Entity\PlatSearch;
use App\Form\PlatType;
use App\Form\PlatSearchType;
use App\Repository\PlatRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Monolog\DateTimeImmutable;

class UserPlanningController extends AbstractController
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
     * @var UserRepository
     */
    private $user_repository;

    public function __construct(PlatRepository $repository, EntityManagerInterface $em, UserRepository $user_repository)
    {
        $this->repository = $repository ;
        $this->user_repository = $user_repository ;
        $this->em = $em ;
    }

    /**
     * @Route ("/user/planning",name="user.planning.index")
     * @return Response
     */
    public function index()
    {
        $current_week=$this->setCommande();
        $date=$this->Date();
        $jour=0;
        return $this->render('user/planning/index.html.twig', ['date'=>$date,'planning' => $current_week,'jour' => $jour]);
        
    }

    /**
     * @Route ("/user/planning/commande/entree/{date}/{creneau}/{id_entree}/{id_plat}/{id_dessert}/{id_user}/",name="user.planning.commande.index") 
     * @return Response
     */
    public function indexCommande($date, $creneau, $id_entree, $id_plat, $id_dessert, $id_user): Response
    {
        $plats = $this->repository->findAll();
        #$date=$this->CalculDate($jour);
        return $this->render('user/planning/commande/index.html.twig', ['date'=>$date,'creneau'=>$creneau,'plats'=>$plats,'id_entree'=>$id_entree,'id_plat'=>$id_plat,'id_dessert'=>$id_dessert,'id_user'=>$id_user]);  
    }

    public function Date(){
        $datejour = new \DateTime('now');
        return $datejour->format('l');  
    }
    
        
    public function setCommande(){
        $commande1 = new Commande();
        $commande1->setCreneaux("dejeuner");
        $commande2 = new Commande();
        $commande2->setCreneaux("diner");
        return ["Monday" => ["Dejeuner"=>$commande1,"Diner"=>$commande2],
                "Tuesday" => ["Dejeuner"=>$commande1,"Diner"=>$commande2],
                "Wednesday" => ["Dejeuner"=>$commande1,"Diner"=>$commande2],
                "Tursday" => ["Dejeuner"=>$commande1,"Diner"=>$commande2],
                "Friday" => ["Dejeuner"=>$commande1,"Diner"=>$commande2],
                "Saturday" => ["Dejeuner"=>$commande1,"Diner"=>$commande2],
        ];
    }

    public function CalculDate(int $i){
        $datejour = new \DateTime('now');
        $jour = $datejour->format('l');

        if($jour=="Monday" && $i==3){ return date('Y-m-d',strtotime('+3 day'));}
        if($jour=="Monday" && $i==4){ return date('Y-m-d',strtotime('+4 day'));}
        if($jour=="Monday" && $i==5){ return date('Y-m-d',strtotime('+5 day'));}
        if($jour=="Monday" && $i==7){ return date('Y-m-d',strtotime('+7 day'));}
        if($jour=="Monday" && $i==8){ return date('Y-m-d',strtotime('+8 day'));}
        if($jour=="Monday" && $i==9){ return date('Y-m-d',strtotime('+9 day'));}
        if($jour=="Monday" && $i==10){ return date('Y-m-d',strtotime('+10 day'));}
        if($jour=="Monday" && $i==11){ return date('Y-m-d',strtotime('+11 day'));}
        if($jour=="Monday" && $i==12){ return date('Y-m-d',strtotime('+12 day'));}

        if($jour=="Tuesday" && $i==4){ return date('Y-m-d',strtotime('+3 day'));}
        if($jour=="Tuesday" && $i==5){ return date('Y-m-d',strtotime('+4 day'));}
        if($jour=="Tuesday" && $i==7){ return date('Y-m-d',strtotime('+6 day'));}
        if($jour=="Tuesday" && $i==8){ return date('Y-m-d',strtotime('+7 day'));}
        if($jour=="Tuesday" && $i==9){ return date('Y-m-d',strtotime('+8 day'));}
        if($jour=="Tuesday" && $i==10){ return date('Y-m-d',strtotime('+9 day'));}
        if($jour=="Tuesday" && $i==11){ return date('Y-m-d',strtotime('+10 day'));}
        if($jour=="Tuesday" && $i==12){ return date('Y-m-d',strtotime('+11 day'));}

        if($jour=="Wednesday" && $i==5){ return date('Y-m-d',strtotime('+3 day'));}
        if($jour=="Wednesday" && $i==7){ return date('Y-m-d',strtotime('+5 day'));}
        if($jour=="Wednesday" && $i==8){ return date('Y-m-d',strtotime('+6 day'));}
        if($jour=="Wednesday" && $i==9){ return date('Y-m-d',strtotime('+7 day'));}
        if($jour=="Wednesday" && $i==10){ return date('Y-m-d',strtotime('+8 day'));}
        if($jour=="Wednesday" && $i==11){ return date('Y-m-d',strtotime('+9 day'));}
        if($jour=="Wednesday" && $i==12){ return date('Y-m-d',strtotime('+10 day'));}

        if($jour=="Thursday" && $i==7){ return date('Y-m-d',strtotime('+4 day'));}
        if($jour=="Thursday" && $i==8){ return date('Y-m-d',strtotime('+5 day'));}
        if($jour=="Thursday" && $i==9){ return date('Y-m-d',strtotime('+6 day'));}
        if($jour=="Thursday" && $i==10){ return date('Y-m-d',strtotime('+7 day'));}
        if($jour=="Thursday" && $i==11){ return date('Y-m-d',strtotime('+8 day'));}
        if($jour=="Thursday" && $i==12){ return date('Y-m-d',strtotime('+9 day'));}
        
        if($jour=="Friday" && $i==7){ return date('Y-m-d',strtotime('+3 day'));}
        if($jour=="Friday" && $i==8){ return date('Y-m-d',strtotime('+4 day'));}
        if($jour=="Friday" && $i==9){ return date('Y-m-d',strtotime('+5 day'));}
        if($jour=="Friday" && $i==10){ return date('Y-m-d',strtotime('+6 day'));}
        if($jour=="Friday" && $i==11){ return date('Y-m-d',strtotime('+7 day'));}
        if($jour=="Friday" && $i==12){ return date('Y-m-d',strtotime('+8 day'));}

        if($jour=="Saturday" && $i==8){ return date('Y-m-d',strtotime('+3 day'));}
        if($jour=="Saturday" && $i==9){ return date('Y-m-d',strtotime('+4 day'));}
        if($jour=="Saturday" && $i==10){ return date('Y-m-d',strtotime('+5 day'));}
        if($jour=="Saturday" && $i==11){ return date('Y-m-d',strtotime('+6 day'));}
        if($jour=="Saturday" && $i==12){ return date('Y-m-d',strtotime('+7 day'));}

        if($jour=="Sunday" && $i==9){ return date('Y-m-d',strtotime('+3 day'));}
        if($jour=="Sunday" && $i==10){ return date('Y-m-d',strtotime('+4 day'));}
        if($jour=="Sunday" && $i==11){ return date('Y-m-d',strtotime('+5 day'));}
        if($jour=="Sunday" && $i==12){ return date('Y-m-d',strtotime('+6 day'));}
    }

    /**
     * @Route ("/user/planning/commande/entree/{jour}/{creneau}",name="user.planning.entree") 
     * @param int jour
     * @return Response
     */
    public function entree($jour, $creneau, Request $request): Response
    {
        $search = new PlatSearch();
        $form=$this->createForm(PlatSearchType::class, $search);
        $form->handleRequest($request);
        #$current_week=$this->setCommande();

        $date=$this->CalculDate($jour);
        $plats = $this->repository->findAllEntreeVisible($date,$search);
        
        return $this->render('user/planning/commande/entree.html.twig', ['date'=>$date,'creneau'=>$creneau,'plats'=>$plats, 'form'=> $form->createView()]);
        
    }

        /**
     * @Route ("/user/planning/commande/entree/{date}/{creneau}/{id_entree}",name="user.planning.plat") 
     * @return Response
     */
    public function plat($date, $creneau, $id_entree, Request $request): Response
    {
        $search = new PlatSearch();
        $form=$this->createForm(PlatSearchType::class, $search);
        $form->handleRequest($request);

        $plats = $this->repository->findAllPlatVisible($date,$search);
        #$date=$this->CalculDate($jour);
        return $this->render('user/planning/commande/plat.html.twig', ['date'=>$date,'creneau'=>$creneau,'plats'=>$plats,'id_entree'=>$id_entree, 'form'=> $form->createView()]);
        
    }

    /**
     * @Route ("/user/planning/commande/entree/{date}/{creneau}/{id_entree}/{id_plat}/",name="user.planning.dessert") 
     * @return Response
     */
    public function dessert($date, $creneau, $id_entree, $id_plat, Request $request): Response
    {
        $search = new PlatSearch();
        $form=$this->createForm(PlatSearchType::class, $search);
        $form->handleRequest($request);

        $plats = $this->repository->findAllDessertVisible($date,$search);
        return $this->render('user/planning/commande/dessert.html.twig', ['date'=>$date,'creneau'=>$creneau,'plats'=>$plats,'id_entree'=>$id_entree,'id_plat'=>$id_plat, 'form'=> $form->createView()]);
        
    }

    /**
     * @Route ("/user/planning/commande/entree/{date}/{creneau}/{id_entree}/{id_plat}/{id_dessert}/{id_user}/add",name="user.planning.add")
     * @return Response
     */
    public function add($date, $creneau, $id_entree, $id_plat, $id_dessert,$id_user)
    {
        $commande= new Commande();
        $commande->setDate(new \DateTime($date));
        $commande->setCreneaux($creneau);
        $commande->setPayed(false);
        $plats = $this->repository->findAll();
        $seniors = $this->user_repository->findAll();


        
        foreach ($seniors as $user) {
            if($user->getId() == $id_user){
                $commande->addSenior($user->getSenior());   
            }
        }
        foreach ($plats as $plat) {
            if($plat->getId() == $id_entree){
                $commande->addPlat($plat);
            }
            if($plat->getId() == $id_plat){
                $commande->addPlat($plat);
            }
            if($plat->getId() == $id_dessert){
                $commande->addPlat($plat);
            }
        }
        $this->em->persist($commande);
        $this->em->flush();
        $this->addFlash('success', 'Commande créer avec succès');
        
        $current_week=$this->setCommande();
        $date=$this->Date();
        $jour=0;
        return $this->redirectToRoute('user.planning.index');
        return $this->render('user/planning/index.html.twig');
        
    }






}