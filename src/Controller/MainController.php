<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
* @Route("/")
* @isGranted("ROLE_USER")
*/
class MainController extends AbstractController{
   
    /**
    * @Route("", name="main")
    */
    public function main(){

        $message = "Hello World";

        return $this->render('base_logged.html.twig', [
            'message' => $message,
        ]);
    }

}