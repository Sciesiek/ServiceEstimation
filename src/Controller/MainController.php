<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/")
*/
class MainController{
   
    /**
    * @Route("")
    */
    public function welcome(){
        $message = "Hello World";

        return new Response(
            '<html><body>Message: '.$message.'</body></html>'
        );
    }

}