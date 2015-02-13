<?php

namespace Ridwan\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ridwan\EntityBundle\Form\AccountType;
use Ridwan\EntityBundle\Entity\Account;

class UserController extends Controller {

    public function indexAction(Request $request) {

        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $userRole = $user->getRoles()[0];
        if ($userRole == 'ADMINISTRATOR' || $userRole = 'NVS'){

            $em = $this->getDoctrine()->getManager();
            $staff = $em->getRepository('RidwanEntityBundle:Authentication')->findAll();
            $volunteers = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->findBy(array('status'=>3));
            $organizations = $em->getRepository('RidwanEntityBundle:Organization')->findBy(array('status'=>3));
            $referees = $em->getRepository('RidwanEntityBundle:Referees')->findAll();

            return $this->render('RidwanUserBundle:Users:nvs.html.twig', array('volunteers' => $volunteers, 'organizations' => $organizations, 'staff' => $staff, 'referees' => $referees));

        }
        return $this->render('RidwanSiteBundle:Error:permission.html.twig');
    }

}
