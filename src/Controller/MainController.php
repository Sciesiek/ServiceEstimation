<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
* @Route("/")
*/
class MainController extends AbstractController{
   
    /**
    * @Route("")
    */
    public function welcome(){
        $message = "Hello World";

        return $this->render('base.html.twig', [
            'message' => $message,
        ]);
    }

}