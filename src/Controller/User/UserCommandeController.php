<?php 

namespace src\Controller\User ;

use App\Entity\User;
use App\Entity\Senior;
use App\Entity\Avis;
use App\Entity\Ingrediant;
use App\Entity\Commande;
use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\SeniorRepository;
use App\Repository\CommandeRepository;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;

class UserCommandeController extends AbstractController
{
    /**
     * @var PlatRepository
     */
    private $repository;

    /**
     * @var CommandeRepository
     */
    private $com_repository;

    /**
     * @var PlatRepository
     */
    private $plat_repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(SeniorRepository $repository, CommandeRepository $com_repository, PlatRepository $plat_repository, EntityManagerInterface $em)
    {
        $this->repository = $repository ;
        $this->com_repository = $com_repository ;
        $this->plat_repository = $plat_repository ;
        $this->em = $em ;
    }

    /**
     * @Route ("/user/commande/",name="user.commande.index")
     * @return Response
     */
    public function index()
    {
        $seniors = $this->repository->findAll();

        return $this->render('user/commande/index.html.twig');
    }

    /**
     * @Route ("/user/commande/info/{id_commande}",name="user.commande.info")
     * @return Response
     */
    public function info($id_commande)
    {
        $commande=new Commande();
        $commandes = $this->com_repository->findAll();
        foreach ($commandes as $co) {
            if($co->getId() == $id_commande){
                $commande=$co;   
            }
        }

        return $this->render('user/commande/info.html.twig',['commande'=>$commande]);
    }

    /**
     * @Route ("/user/commande/info/{id_commande}/{id_plat}",name="user.commande.avis")
     * @return Response
     */
    public function avis($id_plat)
    {
        $plat=new Plat();
        $plats = $this->plat_repository->findAll();
        foreach ($plats as $p) {
            if($p->getId() == $id_plat){
                $plat=$p;   
            }
        }

        return $this->render('user/commande/avis.html.twig',['plat'=>$plat]);
    }

    /**
     * @Route ("/user/commande/info/{id_commande}/{id_plat}/",name="user.commande.add")
     * @return Response
     */
    public function add($id_plat,$star,$description)
    {
        $avis=new Avis($star,$description);

        $plat= new Plat();
        $plats = $this->plat_repository->findAll();
       
        foreach ($seniors as $p) {
            if($p->getId() == $id_plat){
                $plat->addAvis($avis);   
            }
        }

        $this->em->flush();
        $this->addFlash('success', 'Avis ajouter avec succès');
        return $this->redirectToRoute('user.home');

    }

        /**
     * @Route ("user/commande/{id_commande}", name="user.commande.delete", methods="DELETE")
     * @return Response
     */
    public function delete($id_commande, Request $request)
    {
        $commande=new Commande();

        $commandes = $this->com_repository->findAll();
       
        foreach ($commandes as $c) {
            if($c->getId() == $id_commande){
                $commande=$c;  
                var_dump('OK') ;
            }
        }

        if ($this->isCsrfTokenValid('delete'. $commande->getId(), $request->get('_token')))
        {
            var_dump('KO') ;
            $this->em->remove($commande);
            $this->em->flush();
            $this->addFlash('success', 'Commande annuler avec succès');
            return $this->redirectToRoute('user.commande.index');
        }
        return $this->render('user/commande/index.html.twig');
    }




}