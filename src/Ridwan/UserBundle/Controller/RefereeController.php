<?php

namespace Ridwan\UserBundle\Controller;


use Ridwan\EntityBundle\Entity\RefereeAndUser;
use Ridwan\EntityBundle\Form\RefereeAndUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;


class RefereeController extends Controller
{
    const SESSION_EMAIL = 'referee_send_confirmation_email/email';

    /**
     * Generate all the Tokens for Referees
     */
    public function generateAction()
    {
    	$em = $this->getDoctrine()->getManager(); 
        $refereeList = $em->getRepository('RidwanEntityBundle:Referees')->findAll();
        
        foreach($refereeList as $referee){
                    $userId = $referee->getUser();  
        	    $user = $em->getRepository('RidwanEntityBundle:Authentication')->find($userId);
	            $refereeUserRecord = new RefereeAndUser();
	            $refereeUserRecord->setUser($user);
	            $refereeUserRecord->setReferee($referee);
	            $refereeUserRecord->setToken(hash('sha256',rand(10000, 99999)));
	            $refereeUserRecord->setStatus(0);
	            $em->persist($refereeUserRecord);   
        }
        
        $em->flush();  
        return true;     
    }
    
     /**
     * Send all referees email
     */
    public function sendRefereeEmailAction()
    {
    	
    	$em = $this->getDoctrine()->getManager(); 
        $userRefereeList = $em->getRepository('RidwanEntityBundle:RefereeAndUser')->findAll();
        $employmentRepository = $em->getRepository('RidwanEntityBundle:Employment');
        $educationRepository = $em->getRepository('RidwanEntityBundle:Education');
        $refereesRepository = $em->getRepository('RidwanEntityBundle:Referees');
        $authRepository = $em->getRepository('RidwanEntityBundle:Authentication');
        $volunteerRepository = $em->getRepository('RidwanEntityBundle:Volunteerpersonal');
                
        foreach($userRefereeList as $userReferee){
                    $referee = $refereesRepository->find($userReferee->getReferee());
                    $userId = $userReferee->getUser();
                    $employmentDetails = $employmentRepository->findBy(array('user'=>$userId));
        	    $educationDetails = $educationRepository->findBy(array('user'=>$userId)); 
        	    $personalDetails = $volunteerRepository->findOneBy(array('user'=>$userId)); 
        	    $user = $authRepository->find($userReferee->getUser()); 
        	    
        	
        	    /** @var $user UserInterface */
                    //$user = $this->container->get('fos_user.user_manager')->findUserByUsernameOrEmail($auth->getUsername());
                    
        	    $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
                    $this->container->get('fos_user.mailer')->sendRefereeConfirmationEmailMessage($user, $referee, $educationDetails, $employmentDetails, $personalDetails,$userReferee->getToken());           	   
	            
        }
    
        
      
        return true;    
    }
    
    /**
     * Get the truncated email displayed when requesting the resetting.
     *
     * The default implementation only keeps the part following @ in the address.
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     *
     * @return string
     */
    protected function getObfuscatedEmail($user)
    {
        $email = $user->getEmail();
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }

        return $email;
    }
    
     public function approveVolunteerAction($token, $userId, $refereeId){
        $em = $this->getDoctrine()->getManager(); 
        $userRefereeRepository = $em->getRepository('RidwanEntityBundle:RefereeAndUser');
        
        $userReferee = $userRefereeRepository->findOneBy(array('user'=>$userId,'referee'=>$refereeId));        
        
        $userRefereeToken = $userReferee->getToken();
        $userRefereeStatus = $userReferee->getStatus();
        
        if($userRefereeToken == $token){
        	if ($userRefereeStatus == 0){
        		$userReferee->setStatus(1);
        		$em->persist($userReferee);
        		$em->flush();
        		return $this->render('RidwanSiteBundle:Success:success.html.twig',array('message'=>'You have successfully APPROVED'));
        		
        		
        	}else{
        		return $this->render('RidwanSiteBundle:Error:error.html.twig',array('message'=>'This link is no longer valid'));
        	}
        }	
        
        
        return $this->render('RidwanSiteBundle:Error:permission.html.twig');
         
        
    
    }
    
    public function declineVolunteerAction($token, $userId, $refereeId){
    
    	$em = $this->getDoctrine()->getManager(); 
        $userRefereeRepository = $em->getRepository('RidwanEntityBundle:RefereeAndUser');
        
        $userReferee = $userRefereeRepository->findOneBy(array('user'=>$userId,'referee'=>$refereeId));        
        
        $userRefereeToken = $userReferee->getToken();
        $userRefereeStatus = $userReferee->getStatus();
        
        if($userRefereeToken == $token){
        	if ($userRefereeStatus == 0){
        		$userReferee->setStatus(-1);
        		$em->persist($userReferee);
        		$em->flush();
        		return $this->render('RidwanSiteBundle:Success:success.html.twig',array('message'=>'You have successfully DECLINED'));
        		        		
        	}else{
        		return $this->render('RidwanSiteBundle:Error:error.html.twig',array('message'=>'This link is no longer valid'));
        	}
        }        
        
        return $this->render('RidwanSiteBundle:Error:permission.html.twig');
    
    }



}