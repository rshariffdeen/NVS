<?php

namespace Ridwan\OpportunityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ridwan\EntityBundle\Form\AccountType;
use Ridwan\EntityBundle\Entity\Account;


class CompletionController extends Controller
{

    public function completePageAction($opportunityID)
    {
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $em = $this->getDoctrine()->getManager();
        $opportunity = $em->getRepository('RidwanEntityBundle:Opportunities')->find($opportunityID);
        $organization= $em->getRepository('RidwanEntityBundle:Organization')->findOneBy(array('user'=>$user->getId()));

        if ($opportunity->getOrganization() == $organization->getId()){
            return $this->render('RidwanOpportunityBundle:Opportunities:complete.html.twig', array(
                    'Opportunity' => $opportunity,
                    'volunteers' => $this->generateVolunteers($opportunity)
                ));
        }

        return $this->render('RidwanSiteBundle:Error:permission.html.twig');



    }

    public function volunteerFeedbackAction($opportunityID, $userID)
    {
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $em = $this->getDoctrine()->getManager();
        $opportunity = $em->getRepository('RidwanEntityBundle:Opportunities')->find($opportunityID);
        $organization= $em->getRepository('RidwanEntityBundle:Organization')->findOneBy(array('user'=>$user->getId()));
        $volunteer = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->findOneBy(array('user'=>$userID));
        if ($opportunity->getOrganization() == $organization->getId()){
            return $this->render('RidwanOpportunityBundle:feedback:volunteer.html.twig', array(
                    'Opportunity' => $opportunity,
                    'User' => $volunteer
                ));
        }

        return $this->render('RidwanSiteBundle:Error:permission.html.twig');


    }

    public function updateVolunteerAction($opportunityID, $userID, Request $request)
    {
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
        }
        $em = $this->getDoctrine()->getManager();
        $opportunity = $em->getRepository('RidwanEntityBundle:Opportunities')->find($opportunityID);
        $organization= $em->getRepository('RidwanEntityBundle:Organization')->findOneBy(array('user'=>$user->getId()));

        if ($opportunity->getOrganization() == $organization->getId()){
            $volunteer = $em->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user'=>$userID));
            $currentRating = $volunteer->getAggregatedRating();
            $currentWeight = $volunteer->getTotalWeight();
            $opportunityWeight = 1;
            $opportunityRating = $request->get('rating');
            $newRating = (($currentRating*$currentWeight) + ($opportunityWeight*$opportunityRating))/($currentWeight + $opportunityWeight);
            $volunteer->setAggregatedRating($newRating);
            $currentValue = $volunteer->getValue();
            $currentValue += 100;
            $volunteer->setValue($currentValue);
            $completedList = $opportunity->getCompleted();
            if ($completedList == null){
                $completedList = array();
            }
            $completedList[] = $userID;

            $opportunity->setCompleted($completedList);

            if (count($completedList) == $opportunity->getNumberofvolunteers()){
                $opportunity->setStatus(3);
            }

            $em->persist($volunteer);
            $em->persist($opportunity);
            $em->flush();

            $status = $opportunity->getStatus();

            if ($status == 2){
                return $this->redirect($this->generateUrl('ridwan_opportunity_completePage', array('opportunityID'=>$opportunityID)));
            }

            return $this->redirect($this->generateUrl('ridwan_opportunity_index'));



        }

        return $this->render('RidwanSiteBundle:Error:permission.html.twig');


    }

private function generateVolunteers($opportunity){


    $volunteerList = $opportunity->getEnrolled();
    if ($volunteerList == null){
        return null;
    }
    $completedList = $opportunity->getCompleted();
    if ($completedList == null){
        $completedList = array();
    }

    $remainingList = array();

    foreach ($volunteerList as $incomplete){
        $completed = false;
        foreach ($completedList as $complete){
            if ($complete == $incomplete){
                $completed = true;
            }
        }

        if (!$completed){
            $remainingList[] = $incomplete;
        }
    }


    $em = $this->getDoctrine()->getManager();
    $repositoryVolunteers = $em->getRepository('RidwanEntityBundle:Volunteerpersonal');
    $volunteers = array();
    foreach ($remainingList as $member){
        $volunteerProfile = $repositoryVolunteers->findOneBy(array('user'=>$member));
        $volunteers[] = $volunteerProfile;
    }




    return $volunteers;

}



}
