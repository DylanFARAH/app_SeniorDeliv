<?php 

namespace src\Controller ;

use App\Entity\Plat ;
use App\Entity\PlatSearch;
use App\Form\PlatSearchType;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class PlatController extends AbstractController
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
        $this->repository = $repository;
        $this->em = $em;
    } 

    /**
     * @Route ("/plats",name="plat.index")
     */
    public function index(PlatRepository $repository, Request $request)
    {
        $search = new PlatSearch();
        $form=$this->createForm(PlatSearchType::class, $search);
        $form->handleRequest($request);

        $date=date('Y-m-d',strtotime('+3 day'));
        $plats = $this->repository->findAllEntreeVisible($date);
        return $this->render('plat/index.html.twig',['plats' => $plats, 'form'=> $form->createView()]);  
    }

    /**
     * @Route ("/plats/{slug}-{id}",name="plat.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Plat $plat 
     * @return Response
     */
    public function show(Plat $plat, string $slug): Response
    {
        if($plat->getSlug() !== $slug) 
        {
            return $this->redirectToRoute('plat.show', [  //Rediriger en cas de mauvaise url
                'id' => $plat->getId(),
                'slug' => $plat->getSlug()
            ], 301);
        }
        return $this->render('plat/show.html.twig', [
            'plat' => $plat ,
            'current_menu'=> 'plats'
        ]);
    }

}