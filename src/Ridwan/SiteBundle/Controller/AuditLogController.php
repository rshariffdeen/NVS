<?php

namespace Ridwan\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AuditLogController extends Controller {    
   

    public function authenticateAction(Request $request) {
        $accessToken = $this->getRequest()->getSession()->get('authToken');
        if ($accessToken) {
            $this->authenticateSessionAction($accessToken);
        };

        $requestUser = $request->get('userID');
        $verification = $request->get('password');
        $this->authenticateUserAction($requestUser, $verification);
    }

    private function authenticateSessionAction($accessToken) {
        $em = $this->getDoctrine()->getConnection('privileged')->getManager();
        $repository = $em->getRepository('RidwanEntityBundle:Authentication');
        $access = $repository->findOneBy(array('token' => $accessToken));
        if ($access) {
            return $access;
        } else {
            return false;
        }
    } 

    private function authenticateUserAction($requestUser, $verification) {
        $em = $this->getDoctrine()->getConnection('privileged')->getManager();
        $repository = $em->getRepository('RidwanEntityBundle:Authentication');
        $access = $repository->findOneBy(array('$requestingUser' => substr($requestUser, 3), 'type' => substr($requestUser, 0, 3)));
        $verification = $verification . $access->getSalt();
        $success = assert($access->getVerification() == hash('sha256', $verification));
        if ($success) {
            return $access;
        }
        return false;
    }
    
    

    

}
