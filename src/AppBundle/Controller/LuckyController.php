<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{
    /**
     * @Route("/number")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);

        //return new Response('<html><body>'.$number.'</body></html>');

        return $this->render('AppBundle:Lucky:number.html.twig', array(
            'myNumber' => $number,
        ));

    }

}
