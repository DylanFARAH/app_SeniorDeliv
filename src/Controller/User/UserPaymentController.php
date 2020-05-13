<?php 

namespace src\Controller\User ;

use App\Entity\User;
use App\Entity\Senior;
use App\Entity\Ingrediant;
use App\Entity\Commande;
use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\SeniorRepository;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;

class UserPaymentController extends AbstractController
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
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(SeniorRepository $repository, CommandeRepository $com_repository, EntityManagerInterface $em)
    {
        $this->repository = $repository ;
        $this->com_repository = $com_repository ;
        $this->em = $em ;
    }


    /**
     * @Route ("/user/commande/paiement",name="user.paiement")
     * @return Response
     */
    public function index()
    {

        return $this->render('user/commande/paiement.html.twig');
    }

    /**
     * @Route ("/payment",name="user.payment")
     * @return Response
     */
    public function indexPayment()
    {

        return $this->render('Stripe/index.php');
    }






}