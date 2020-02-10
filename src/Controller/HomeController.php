<?php 

namespace src\Controller ;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig ;
        phpinfo();
    }

    public function index()
    {
        return new Response($this->twig->render('pages/home.html.twig'));     
    }
}