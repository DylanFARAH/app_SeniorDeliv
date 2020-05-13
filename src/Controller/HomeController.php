<?php 

namespace src\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     * @var Environment
     */
    
    /**
    * @Route ("/home",name="home.index")
    */
    public function index()
    {

        return $this->render('pages/home.html.twig');
       // return new Response($this->twig->render('pages/home.html.twig'));     
    }
}