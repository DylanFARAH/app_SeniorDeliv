<?php 

namespace src\Controller\User ;

use App\Entity\Contact;
use App\Notification\ContactNotification;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class UserHomeController extends AbstractController
{
    /**
     * @Route ("user/home", name="user.home")
     * @var Environment
     */

    public function index()
    {
        return $this->render('user/user.home.html.twig');
       // return new Response($this->twig->render('pages/home.html.twig'));     
    }

    /**
     * @Route ("user/contact", name="user.contact")
     * @var Environment
     */

    public function contact(ContactNotification $notif, Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $notif->notify($contact);
            $this->addFlash('success', 'Mail envoyer avec succès');
            return $this->redirectToRoute('user.home');
        }
 
        return $this->render('user/user.contact.html.twig', [ 
            'form' => $form->createView()
            ]);
       // return new Response($this->twig->render('pages/home.html.twig'));     
    }


}