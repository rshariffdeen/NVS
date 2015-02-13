<?php

namespace Ridwan\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class AuthenticationController extends Controller
{

    //If the session is active Authentication can be done using the session
    public function authenticateSessionAction(Request $request) {
        $session = $request->getSession();
        if ($session->has('authToken')){
        $accessToken = $session->get('authToken'); //check for access token
        $em = $this->getDoctrine()->getConnection('privileged')->getManager();  //use the privilege user to access the database
        $repository = $em->getRepository('RidwanEntityBundle:Authentication');
        $access = $repository->findOneBy(array('token' => $accessToken)); //access token should be unique
        if ($access) {
            return $access;
        }}
        return false;
    }

    //If a new User is getting authenticated via login interface
    public function authenticateUserAction($requestUser, $verification) {        
        $repository = $this->em->getRepository('RidwanEntityBundle:Authentication'); //divide the user ID into  user two main parts USERTYPE-USERID, VOL-1234 etc
        $access = $repository->findOneBy(array('requestingUser' => substr($requestUser, 3), 'type' => substr($requestUser, 0, 3)));
        if ($access == null){
            return false;
        }
        $verification = $verification . $access->getSalt();     //append the salt value
        $success = assert($access->getVerification() == hash('sha256', $verification)); // use secure hash algo
        if ($success) {
            return $access;
        }
        return false;
    }

    public function checkUserNameAction($name){
        $result= "false";
        $user = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Authentication')->findOneBy(array('username'=>$name));
        if ($user){
            $result= "true";
        }
        return $this->render("RidwanSiteBundle:Empty:message.html.twig",array('result'=>$result));
    }

    public function checkEmailAction($email){
        $result= "false";
        $user = $user = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Authentication')->findOneBy(array('email'=>$email));
        if ($user){
            $result= "true";
        }
        return $this->render("RidwanSiteBundle:Empty:message.html.twig",array('result'=>$result));
    }
}
