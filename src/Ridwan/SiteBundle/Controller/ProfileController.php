<?php

namespace Ridwan\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ridwan\EntityBundle\Entity\Profile;
use Ridwan\EntityBundle\Entity\Photo;
use Ridwan\EntityBundle\Form\ProfileType;
use Symfony\Component\HttpFoundation\Session\Session;
use Ridwan\EntityBundle\Entity\Availability;
use Ridwan\EntityBundle\Form\AvailabilityType;
class ProfileController extends Controller {

    public function profileAction($ID, Request $request) {
        $authenticatedUser = $this->getUser();
        if ($authenticatedUser) {
            $type = $authenticatedUser->getRoles()[0];
            if ($type == 'NVS' || $type == 'Administrator'){
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('RidwanEntityBundle:Authentication');
                $user = $repository->find($ID);
                if ($user == null ){
                    return $this->render('RidwanSiteBundle:Error:error.html.twig', array('message'=>" user doesn't exists"));
                }

                $profile = $this->getProfile($user);
                if ($profile == null){
                    return $this->render('RidwanSiteBundle:Error:error.html.twig', array('message'=>" user doesn't exists"));
                }

                if ($profile[0] == 'VOLUNTEER'){

                return $this->render('RidwanSiteBundle:Profile:volunteer.html.twig', $profile[1]);
                }
                if ($profile[0] == 'ORGANIZATION'){

                    return $this->render('RidwanSiteBundle:Profile:organization.html.twig', $profile[1]);
                }
            }
            elseif($type == 'ORGANIZATION'){
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('RidwanEntityBundle:Opportunities');
                $profile = $em->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user'=>$ID));
                
                $organization= $em->getRepository('RidwanEntityBundle:Organization')->findOneBy(array('user'=>$authenticatedUser->getId()));
                //die('stop');
                $opportunities = $em->getRepository('RidwanEntityBundle:Opportunities')->findBy(array('organization'=>$organization->getId()));
                $access = false;
                foreach ($opportunities as $opportunity){
                	
                	 if ($profile->getCurrent() == $opportunity->getId()){
                    		$access = true;
                }
                }
                
                if ($access == false){
                    return $this->render('RidwanSiteBundle:Error:permission.html.twig');
                }

                $authRepository = $em->getRepository('RidwanEntityBundle:Authentication');
                $user = $authRepository->find($ID);
                $profile = $this->getProfile($user);
                return $this->render('RidwanSiteBundle:Profile:volunteer.html.twig', $profile[1]);

            }
            return $this->render('RidwanSiteBundle:Error:permission.html.twig');
        }
        return $this->redirect($this->generateUrl('ridwan_site_home'));
    }

    private function getProfile($profile) {
        $profileType = $profile->getRoles()[0];
        $profileInfo = null;
        switch ($profileType){
        case 'VOLUNTEER':
            $profileInfo = $this->getVolunteerInformation($profile);
            break;
        case 'ORGANIZATION':
            $profileInfo = $this->getOrganizationInformation($profile);
            break;

            default:
        }
        return array($profileType, $profileInfo);
    }



    private function getVolunteerInformation($authProfile){
        $em = $this->getDoctrine()->getManager();
        $personalDetails = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->findOneBy(array('user'=>$authProfile));
        $contactDetails = $em->getRepository('RidwanEntityBundle:Volunteercontactdetails')->findOneBy(array('user'=>$authProfile));
        $education = $em->getRepository('RidwanEntityBundle:Education')->findBy(array('user'=>$authProfile));
        $employment = $em->getRepository('RidwanEntityBundle:Employment')->findBy(array('user'=>$authProfile));
        $skills = $em->getRepository('RidwanEntityBundle:Skills')->findOneBy(array('user'=>$authProfile));
        $profile = $em->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user'=>$authProfile));
        $availability = $em->getRepository('RidwanEntityBundle:Availability')->findOneBy(array('user'=>$authProfile));
        $referees = $em->getRepository('RidwanEntityBundle:Referees')->findBy(array('user'=>$authProfile->getId()));
        $refereeStatus = $em->getRepository('RidwanEntityBundle:RefereeAndUser')->findBy(array('user'=>$authProfile->getId()));

        $form = $this->createForm(
            new AvailabilityType(), $availability, array(
                'method' => 'POST',
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );
        return array ('referees' => $referees,'authProfile'=>$authProfile,'personal' => $personalDetails, 'education' => $education, 'employment' => $employment, 'contact' => $contactDetails, 'skills'=> $skills, 'profile' => $profile,'refereeStatus' => $refereeStatus,'availability'=>$form->createView());
    }

    private function getOrganizationInformation($authProfile){
        $em = $this->getDoctrine()->getManager();
        $generalDetails = $em->getRepository('RidwanEntityBundle:Organization')->findOneBy(array('user'=>$authProfile));
        $contactDetails = $em->getRepository('RidwanEntityBundle:Organizationcontactdetails')->findOneBy(array('user'=>$authProfile));

        return array ('authProfile'=>$authProfile,'details' => $generalDetails,'contact' => $contactDetails);
    }


}