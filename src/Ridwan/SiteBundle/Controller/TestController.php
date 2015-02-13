<?php

namespace Ridwan\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        return $this->render('RidwanSiteBundle:Default:message.html.twig');
    }
}
