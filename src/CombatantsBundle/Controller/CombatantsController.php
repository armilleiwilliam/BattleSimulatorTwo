<?php

namespace CombatantsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CombatantsController extends Controller
{
    /**
     * @Route("/about-me/", name="about")
     * @Method("GET")
     */
    public function aboutAction(){
        return new Response("<h1>hello</h1>");
    }
}
