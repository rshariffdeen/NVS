<?php

namespace Ridwan\OpportunityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ridwan\EntityBundle\Form\AccountType;
use Ridwan\EntityBundle\Entity\Account;


class AssignmentController extends Controller {

    public function indexAction(Request $request){
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $userRole = $user->getRoles()[0];
        if ($userRole == 'ADMINISTRATOR' || $userRole = 'NVS'){

            $em = $this->getDoctrine()->getManager();
            //Find all Opportunities that need volunteers to be assigned
            $opportunities = $em->getRepository('RidwanEntityBundle:Opportunities')->findBy(array('status'=>1));

            return $this->render('RidwanOpportunityBundle:Assignment:index.html.twig', array('Opportunities' => $opportunities));
        }
        return $this->render('RidwanSiteBundle:Error:permission.html.twig');
    }

    public function detailsAction(Request $request,$opportunityID){
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $userRole = $user->getRoles()[0];
        if ($userRole == 'ADMINISTRATOR' || $userRole = 'NVS'){

            $em = $this->getDoctrine()->getManager();
            //Find the Opportunity that need volunteers to be assigned
            $opportunity = $em->getRepository('RidwanEntityBundle:Opportunities')->find($opportunityID);
            $systemMatch = $opportunity->getSystemmatch();
            if ($systemMatch = null){
                $systemMatch = $this->generateVolunteers($opportunity);
            }
            return $this->render('RidwanOpportunityBundle:Assignment:details.html.twig', array('Opportunity' => $opportunity, 'volunteers' => $this->generateVolunteers($opportunity)));
        }
        return $this->render('RidwanSiteBundle:Error:permission.html.twig');
    }

    private function generateVolunteers($opportunity){
        $volunteers = array();
        $em = $this->getDoctrine()->getManager();
        $repositoryVolunteers = $em->getRepository('RidwanEntityBundle:Volunteerpersonal');
        $repositorySkills = $em->getRepository('RidwanEntityBundle:Skills');
        $repositoryAvailability = $em->getRepository('RidwanEntityBundle:Availability');
        $primarySkillMatch = $repositorySkills->findBy(array('primary' => $opportunity->getRole()));
        $secondarySkillMatch = $repositorySkills->findBy(array('secondary' => $opportunity->getRole()));

        foreach ($primarySkillMatch as $member){
            $user = $em->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user'=>$member->getUser()));
            if ($user != null){
             $current = $user ->getCurrent();
             }
            if ($current == 0){
            $volunteer= $repositoryVolunteers->findOneBy(array('user'=>$member->getUser()));
            
            if ($volunteer->getStatus() == 3){                	
                    $volunteers[] = $volunteer;
                }
                }

        }
        foreach ($secondarySkillMatch as $member){
            $user = $em->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user'=>$member->getUser()));
            if ($user != null){
             $current = $user ->getCurrent();
             }
            if ($current == 0){
            $volunteer= $repositoryVolunteers->findOneBy(array('user'=>$member->getUser()));
            
            if ($volunteer->getStatus() == 3){                	
                    $volunteers[] = $volunteer;
                }
                }
        }

        return $volunteers;

    }

    private function filterSuggestion($volunteers, $opID){
        if ($volunteers != null){
            foreach ($volunteers as $volunteer){
                $userID = $volunteer->getUser()->getId();
                $em = $this->getDoctrine()->getManager();
                $opportunity = $em->getRepository('RidwanEntityBundle:Opportunities')->find($opID);
                $profile = $em->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user'=>$userID));
                $rejected = $opportunity->getInterested();
                $accepted = $opportunity->getEnrolled();
                $suggested = $opportunity->getSystemmatch();
		
              
                
                if ($rejected != null){
                    foreach ($rejected as $reject){
                        if ($reject == $userID){
                            $volunteer = null;
                        }
                    }
                }

                if ($accepted != null){
                    foreach ($accepted as $accept){
                        if ($accept == $userID){
                            $volunteer = null;
                        }
                    }
                }


                if ($suggested != null){

                    foreach ($suggested as $suggest){
                        if ($suggest == $userID){
                            $volunteer->setUser(null);
                        }
                    }
                }

            }
            return $volunteers;
        }
        return null;
    }

    public function suggestAction($userID, $opID){

        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $userRole = $user->getRoles()[0];
        if ($userRole == 'ADMINISTRATOR' || $userRole = 'NVS'){

            $em = $this->getDoctrine()->getManager();
            //Find all Opportunities that need volunteers to be assigned
            $opportunity = $em->getRepository('RidwanEntityBundle:Opportunities')->find($opID);
            $volunteerProfile = $em->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user' => $userID));

            $systemMatch = $opportunity->getSystemmatch();
            if ($systemMatch == null){
                $systemMatch = array();
            }

            $systemMatch[] = $userID;
            $opportunity->setSystemmatch($systemMatch);

            $volunteerOpportunities = $volunteerProfile->getOpportunities();
            if ($volunteerOpportunities == null){
                $volunteerOpportunities = array();
            }
            $volunteerOpportunities[] = $opID;
            $volunteerProfile->setOpportunities($volunteerOpportunities);

            $em->persist($opportunity);
            $em->persist($volunteerProfile);
            $em->flush();
            $this->sendNewOpportunityEmailAction($userID);

            return $this->redirect($this->generateUrl('ridwan_opportunity_assignment_details', array('opportunityID'=>$opID,'type'=>'S','message'=>'notified volunteer')));


        }
        return $this->render('RidwanSiteBundle:Error:permission.html.twig');


    }

     /**
     * Send volunteer new opportunity email message
     */
    public function sendNewOpportunityEmailAction($userId)
    {
        //const SESSION_EMAIL = 'volunteer_send_complete_email/email';
    
        $em = $this->getDoctrine()->getManager();         
        $authRepository = $em->getRepository('RidwanEntityBundle:Authentication');   
        //$userId = $this->getUser()->getId();                   
        $user = $authRepository->find($userId); 
       // $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
        $result = $this->container->get('fos_user.mailer')->sendNewOpportunityEmailMessage($user);
       // echo "email: " . $result;
        return true;   
    }
    
      /**
     * Get the truncated email displayed
     *
     * The default implementation only keeps the part following @ in the address.
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     *
     * @return string
     */
    protected function getObfuscatedEmail(UserInterface $user)
    {
        $email = $user->getEmail();
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }

        return $email;
    }


}