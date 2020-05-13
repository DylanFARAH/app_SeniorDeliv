<?php 

namespace src\Controller\Admin ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AdminHomeController extends AbstractController
{
    /**
     * @Route ("admin/home", name="admin.home")
     * @var Environment
     */

    public function index()
    {
        return $this->render('admin/admin.home.html.twig');
       // return new Response($this->twig->render('pages/home.html.twig'));     
    }
}