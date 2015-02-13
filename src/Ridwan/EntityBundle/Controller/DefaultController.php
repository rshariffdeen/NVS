<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RidwanEntityBundle:Default:message.html.twig', array('name' => $name));
    }
}
