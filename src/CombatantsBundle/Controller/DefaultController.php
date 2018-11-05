<?php

namespace CombatantsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('CombatantsBundle:Default:index.html.twig');
    }

    /**
     * @Route("/about", name="about-me")
     */
    public function aboutAction()
    {
        return $this->render('CombatantsBundle:Default:about.html.twig');
    }
}
