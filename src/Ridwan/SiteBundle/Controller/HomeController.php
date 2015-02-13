<?php

namespace Ridwan\SiteBundle\Controller;

use Ridwan\SiteBundlle\Controller\AuthenticationController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ridwan\EntityBundle\Entity\Organization;
use Ridwan\EntityBundle\Entity\Availability;
use Ridwan\EntityBundle\Form\AvailabilityType;
class HomeController extends Controller
{
    public function homeAction(Request $request)
    {
    
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $userRole = $user->getRoles()[0];
        switch ($userRole) {
        case 'VOLUNTEER':
            return $this->volunteerHome($request);
        case 'ORGANIZATION':
            return $this->organizationHome($request);
        case 'NVS':
            return $this->NVSHome($request);
        case 'ADMINISTRATOR':
            return $this->adminHome($request);
        default:
            return $this->specialHome($request);
        }

    }

    private function volunteerHome(Request $request)
    {
        $volunteer = $this->getVolunteer();
        if ($volunteer) {
            $status = $volunteer->getStatus();
            if ($status == -1) { //Profile Rejected by NVS
                return $this->render('RidwanSiteBundle:Error:error.html.twig', array('message' => 'NVS rejected your application'));
            }
            if ($status == 0) { //Email Verified
                return $this->render('RidwanUserBundle:Welcome:volunteer.html.twig');
            }

            if ($status == 1) { //Profile Completed
                return $this->render('RidwanUserBundle:Welcome:completed.html.twig');
            }

            if ($status == 3) { //Profile Approved by NVS
                return $this->render('RidwanSiteBundle:Home:volunteer.html.twig', $this->generateVolunteerHome($request));

            }


        }
        return $this->render('RidwanUserBundle:Welcome:volunteer.html.twig');

    }

    private function generateVolunteerHome(Request $request){
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $personalDetails = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->findOneBy(array('user'=>$user));
        $contactDetails = $em->getRepository('RidwanEntityBundle:Volunteercontactdetails')->findOneBy(array('user'=>$user));
        $eudcation = $em->getRepository('RidwanEntityBundle:Education')->findBy(array('user'=>$user));
        $employment = $em->getRepository('RidwanEntityBundle:Employment')->findBy(array('user'=>$user));
        $skills = $em->getRepository('RidwanEntityBundle:Skills')->findOneBy(array('user'=>$user));
        $profile = $em->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user'=>$user));
        $availability = $em->getRepository('RidwanEntityBundle:Availability')->findOneBy(array('user'=>$user));
        $form = $this->createForm(
            new AvailabilityType(), $availability, array(
                'method' => 'POST',
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );
        return array ('personal' => $personalDetails, 'education' => $eudcation, 'employment' => $employment, 'contact' => $contactDetails, 'skills'=> $skills, 'profile' => $profile,'availability'=>$form->createView(),'message' => $request->get('message'), 'type' => $request->get('type'));
    }



    private function getVolunteer()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteerpersonal');
        return $repository->findOneBy(array("user" => $this->getUser()->getId()));
    }

    private function getOrganization()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Organization');
        return $repository->findOneBy(array("user" => $this->getUser()->getId()));
    }

    private function organizationHome(Request $request)
    {
        $organization = $this->getOrganization();
        if ($organization) {
            $status = $organization->getStatus();
            if ($status == -1) { //Profile Rejected by NVS
                return $this->render('RidwanSiteBundle:Error:error.html.twig', array('message' => 'NVS rejected your application'));
            }

            if ($status == 0) { //Email Verified
                return $this->render('RidwanUserBundle:Welcome:organization.html.twig');
            }

            if ($status == 1) { //Profile Completed
                return $this->render('RidwanUserBundle:Welcome:completed.html.twig');
            }

            if ($status == 3) { //Profile Completed

            return $this->render('RidwanSiteBundle:Home:organization.html.twig', array(
                    'details' => $organization,
                    'contact' => $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Organizationcontactdetails')->findOneBy(array('user'=>$this->getUser()->getId())),
                    'message' => $request->get('message'), 'type' => $request->get('type')
                ));
            }
        }
        return $this->render('RidwanUserBundle:Welcome:organization.html.twig');


    }

    private function NVSHome(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $volunteers = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->findBy(array('status'=>1));
        $organizations = $em->getRepository('RidwanEntityBundle:Organization')->findBy(array('status'=>1));
        $rejectedOp = count($em->getRepository('RidwanEntityBundle:Opportunities')->findBy(array('status'=>-1)));
        $ongoingOp = count($em->getRepository('RidwanEntityBundle:Opportunities')->findBy(array('status'=>0)));
        $pendingOp = count($em->getRepository('RidwanEntityBundle:Opportunities')->findBy(array('status'=>1)));
        $completedOp = count($em->getRepository('RidwanEntityBundle:Opportunities')->findBy(array('status'=>2)));
        $rejectedOrg = count($em->getRepository('RidwanEntityBundle:Organization')->findBy(array('status'=>-1)));
        $activeOrg = count($em->getRepository('RidwanEntityBundle:Organization')->findBy(array('status'=>3)));
        $pendingOrg = count($em->getRepository('RidwanEntityBundle:Organization')->findBy(array('status'=>1)));
        $rejectedVol = count($em->getRepository('RidwanEntityBundle:Volunteerpersonal')->findBy(array('status'=>-1)));
        $activeVol = count($em->getRepository('RidwanEntityBundle:Volunteerpersonal')->findBy(array('status'=>3)));
        $pendingVol = count($em->getRepository('RidwanEntityBundle:Volunteerpersonal')->findBy(array('status'=>1)));

        return $this->render('RidwanSiteBundle:Home:NVS.html.twig', array(
                'volunteers' => $volunteers,
                'organizations' => $organizations,
                'message' => $request->get('message'),
                'type' => $request->get('type'),
                'RejectedOP' => $rejectedOp,
                'CurrentOP' => $ongoingOp,
                'PendingOP' => $pendingOp,
                'CompletedOP' => $completedOp,
                'RejectedOrg' => $rejectedOrg,
                'ActiveOrg' => $activeOrg,
                'PendingOrg' => $pendingOrg,
                'RejectedVol' => $rejectedVol,
                'ActiveVol' => $activeVol,
                'PendingVol' => $pendingVol,


            ));
    }

    private function adminHome(Request $request)
    {
        $volunteers = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteerpersonal')->findBy(array('status'=>1));
        $organizations = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Volunteerpersonal')->findBy(array('status'=>1));

        return $this->render('RidwanSiteBundle:Home:admin.html.twig', array('volunteers' => $volunteers,'message' => $request->get('message'), 'type' => $request->get('type')));
    }

    private function SpecialHome(Request $request)
    {
        return $this->render('RidwanSiteBundle:Home:special.html.twig',array('message' => $request->get('message'), 'type' => $request->get('type')));
    }


}