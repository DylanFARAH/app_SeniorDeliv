<?php 

namespace src\Controller\Admin ;

use App\Entity\Plat;
use App\Entity\Ingrediant;
use App\Form\PlatType;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AdminCommandeController extends AbstractController
{
    /**
     * @var CommandeRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(CommandeRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository ;
        $this->em = $em ;
    }

    /**
     * @Route ("/admin/commande",name="admin.commande.index")
     * @return Response
     */
    public function index()
    {
        $commandes = $this->repository->findAll();
        return $this->render('admin/commande/index.html.twig', [
            'commandes'=>$commandes
        ]);
    }
    public function date(){
        $date=new \DateTime('now');
        return date_format($date, 'Y-m-d');
    }
    /**
     * @Route ("/admin/commande/csv",name="admin.commande.csv")
     * @return Response
     */
    public function GenereCSV(){
        $commandes = $this->repository->findAll();
        $v=[""];
        $tab=[$v];
        $var="";
        
        foreach($commandes as $commande){
            $var=$var.$commande->getId()."|" ;
            foreach($commande->getPlats() as $plat){
            $var=$var." ".$plat->getId() ;
            }
            $var=$var."|".$commande->getCreneaux() ;
            $var=$var."|".$commande->DatetoString().";" ;
            $stack = array("orange", "banana");
            array_push($tab, [$var]);
        }
        
        $fp = fopen($this->date()."_COMMANDE.csv", "w");
        foreach($tab as $fields){
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return $this->render('admin/commande/index.html.twig', [
            'commandes'=>$commandes
        ]);
    }

}