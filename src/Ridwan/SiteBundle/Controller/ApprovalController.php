<?php

namespace Ridwan\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ridwan\EntityBundle\Form\AccountType;
use Ridwan\EntityBundle\Entity\Account;


class ApprovalController extends Controller {

    public function volunteerAction(Request $request, $userID){
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $userRole = $user->getRoles()[0];
        if ($userRole == 'ADMINISTRATOR' || $userRole = 'NVS'){

            $em = $this->getDoctrine()->getManager();
            $volunteer = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->find($userID);
            $volunteer->setStatus(3);
            $em->persist($volunteer);
            $em->flush();
            $this->sendVolunteerApprovedEmailAction($volunteer->getUser());
            return $this->redirect($this->generateUrl('ridwan_site_home', array('type' => 'S', 'message' => 'successfully approved the volunteer')));
        }
        return $this->render('RidwanSiteBundle:Error:permission.html.twig');
    }

    public function opportunityAction(Request $request, $opID){
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $userRole = $user->getRoles()[0];
        if ($userRole == 'ADMINISTRATOR' || $userRole = 'NVS'){
            echo $opID;
            $opportunity = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Opportunities')->find($opID);
            $opportunity->setStatus(1);
            $em = $this->getDoctrine()->getManager();
            $organization = $em->getRepository('RidwanEntityBundle:Organization')->find($opportunity->getOrganization());
            $em = $this->getDoctrine()->getManager();
            $em->persist($opportunity);
            
            $this->sendOpportunityApprovedEmailAction($organization->getUser());
            $em->flush();
            return $this->redirect($this->generateUrl('ridwan_opportunity_index', array('type' => 'S', 'message' => 'successfully added the opportunity')));
        }
        return $this->render('RidwanSiteBundle:Error:permission.html.twig');
    }

    public function organizationAction(Request $request, $userID){
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $userRole = $user->getRoles()[0];
        if ($userRole == 'ADMINISTRATOR' || $userRole = 'NVS'){
            $em = $this->getDoctrine()->getManager();
            $organization = $em->getRepository('RidwanEntityBundle:Organization')->find($userID);
            $organization->setStatus(3);
            $em->persist($organization);
            $em->flush();
            $this->sendOrganizationApprovedEmailAction($organization->getUser());
            return $this->redirect($this->generateUrl('ridwan_site_home', array('type' => 'S', 'message' => 'successfully approved the organization')));

        }
        return $this->render('RidwanSiteBundle:Error:permission.html.twig');
    }


    public function refereeAction(Request $request){
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $userRole = $user->getRoles()[0];
        if ($userRole == 'ADMINISTRATOR' || $userRole = 'NVS'){

        }
        return $this->render('RidwanSiteBundle:Error:permission.html.twig');
    }
    
    /**
     * Send volunteer profile approved email
     */
    public function sendVolunteerApprovedEmailAction($userId)
    {
        //const SESSION_EMAIL = 'volunteer_send_complete_email/email';
    
        $em = $this->getDoctrine()->getManager();         
        $authRepository = $em->getRepository('RidwanEntityBundle:Authentication');              
        $user = $authRepository->find($userId); 
       // $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
        $this->container->get('fos_user.mailer')->sendVolunteerApprovedEmailMessage($user);
        return true;   
    }
    
     /**
     * Send organization profile approved email
     */
    public function sendOrganizationApprovedEmailAction($userId)
    {
        //const SESSION_EMAIL = 'volunteer_send_complete_email/email';
    
        $em = $this->getDoctrine()->getManager();         
        $authRepository = $em->getRepository('RidwanEntityBundle:Authentication');              
        $user = $authRepository->find($userId); 
       // $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
        $this->container->get('fos_user.mailer')->sendOrganizationApprovedEmailMessage($user);
        return true;   
    }
    
    /**
     * Send organization opportunity approved email
     */
    public function sendOpportunityApprovedEmailAction($userId)
    {
        //const SESSION_EMAIL = 'volunteer_send_complete_email/email';
    
        $em = $this->getDoctrine()->getManager();         
        $authRepository = $em->getRepository('RidwanEntityBundle:Authentication');              
        $user = $authRepository->find($userId); 
       // $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
        $this->container->get('fos_user.mailer')->sendOpportunityApprovedEmailMessage($user);
        return true;   
    }
}