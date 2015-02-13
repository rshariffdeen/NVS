<?php

namespace Ridwan\OpportunityBundle\Controller;

use Ridwan\EntityBundle\Entity\Opportunities;
use Ridwan\EntityBundle\Form\OpportunitiesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class OpportunityController extends Controller
{

    private function getOrganization()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Organization');
        return $repository->findOneBy(array("user" => $this->getUser()->getId()));
    }

    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        if ($user) {
            $type = $user->getRoles()[0];
            $em = $this->getDoctrine()->getManager();
            $Repository = $em->getRepository('RidwanEntityBundle:Opportunities');
            /*$NotificationRepository = $em->getRepository('RidwanEntityBundle:Notification');
            $NotificationsQuery = $NotificationRepository->createQueryBuilder('p')
                ->where('p.userid = :id AND p.seen = 0')
                ->setParameter('id', $user->getId())
                ->setMaxResults(10)
                ->orderBy('p.id', 'DESC')
                ->getQuery();
            $Notifications = $NotificationsQuery->getResult();
            */
            if ($type == 'ORGANIZATION') {
                $opportunities = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Opportunities')->findBy(array('organization'=>$this->getOrganization()));
                return $this->render(
                    'RidwanOpportunityBundle:Opportunities:organization.html.twig', array(
                        'Opportunities' => $opportunities,
                        'message' => $request->get('message'),
                        'type' => $request->get('type'),
                        'organization' => $this->getOrganization()->getName()
                    )
                );
            }

            if ($type == 'VOLUNTEER') {
                $opportunityList = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user'=>$user))->getOpportunities();
                $opportunityCurrent = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Profile')->findOneBy(array('user'=>$user))->getCurrent();
                $opportunities = array();
                if ($opportunityList != null){
                    foreach( $opportunityList as$op){
                        $opportunities[] = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Opportunities')->find($op);
                    }

                }
                if ($opportunityCurrent == null){
                	$opportunityCurrent = 0;
                }
                $current = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Opportunities')->find($opportunityCurrent);
                return $this->render(
                    'RidwanOpportunityBundle:Opportunities:volunteer.html.twig', array(
                        'Opportunities' => $opportunities,
                        'current' => $current,
                        'message' => $request->get('message'),
                        'type' => $request->get('type'),
                    )

                );



            }
            if ($type == 'NVS') {

                $opportunities = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Opportunities')->findBy(array('status'=>0));
                return $this->render(
                    'RidwanOpportunityBundle:Opportunities:nvs.html.twig', array(
                        'opportunities' => $opportunities,
                        'message' => $request->get('message'),
                        'type' => $request->get('type'),
                    )
                );
            }else {

                $opportunities = $this->getDoctrine()->getManager()->getRepository('RidwanEntityBundle:Opportunities')->findBy(array('status'=>0));
                return $this->render(
                    'RidwanOpportunityBundle:Opportunities:admin.html.twig', array(
                        'opportunities' => $opportunities,
                        'message' => $request->get('message'),
                        'type' => $request->get('type'),
                    )
                );
            }
        }

        return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
    }

    public function detailAction($opportunityID, Request $request)
    {
        $user = $this->getUser();
        if ($user) {

            $em = $this->getDoctrine()->getManager();
            $OpportunityRepository = $em->getRepository('RidwanEntityBundle:Opportunities');
            $Opportunity = $OpportunityRepository->find($opportunityID);
            if ($Opportunity == null) {
                return $this->render(
                    'RidwanSiteBundle:Error:error.html.twig',
                    array('message' => " Opportunity doesn't exists")
                );
            }

            return $this->render(
                'RidwanOpportunityBundle:Opportunities:details.html.twig', array(
                    'Opportunity' => $Opportunity,
                'volunteers' => $this->generateVolunteers($Opportunity),
                    'message' => $request->get('message'),
                    'type' => $request->get('type'),
                    'organization' => $this->getOrganization()->getId()

                )
            );
        }
        return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
    }


    private function getUserAction($userID)
    {
        $em = $this->getDoctrine()->getManager();
        $UserRepository = $em->getRepository('ridwanEntityBundle:User');
        $manager = $UserRepository->find(array('id' => $userID));
        return $manager;
    }



    private function generateVolunteers($opportunity){

        $volunteerList = $opportunity->getEnrolled();
        if ($volunteerList == null){
            return null;
        }
        $em = $this->getDoctrine()->getManager();
        $repositoryVolunteers = $em->getRepository('RidwanEntityBundle:Volunteerpersonal');
        $volunteers = array();
        foreach ($volunteerList as $member){
            $volunteerProfile = $repositoryVolunteers->findOneBy(array('user'=>$member));
            $volunteers[] = $volunteerProfile;
        }


        return $volunteers;

    }

    public function completePageAction($OpportunityID)
    {
        $user = $this->authenticateAction();
        if ($user) {
            $access = $user->getAccesslevel();
            if ($access == 'Head' || $access == 'Admin') {
                $em = $this->getDoctrine()->getManager();
                $OpportunityRepository = $em->getRepository('ridwanEntityBundle:Opportunity');
                $Opportunity = $OpportunityRepository->find($OpportunityID);
                $NotificationRepository = $em->getRepository('ridwanEntityBundle:Notification');
                $NotificationsQuery = $NotificationRepository->createQueryBuilder('p')
                    ->where('p.userid = :id AND p.seen = 0')
                    ->setParameter('id', $user->getId())
                    ->setMaxResults(10)
                    ->orderBy('p.id', 'DESC')
                    ->getQuery();
                $Notifications = $NotificationsQuery->getResult();
                $User = $this->getUserAction($Opportunity->getUser());
                return $this->render(
                    'ridwanOpportunityBundle:Opportunitys:complete.html.twig', array(
                        'Opportunity' => $Opportunity,
                        'User' => $User,
                        'Notifications' => $Notifications
                    )
                );
            } else {
                return $this->render(
                    'ridwanStyleBundle:Error:permission.html.twig', array(
                        'Notifications' => $Notifications
                    )
                );
            }
        }
        return $this->redirect($this->generateUrl('ridwan_site_login'));
    }

    public function completeOpportunityAction(Request $request)
    {
        $user = $this->authenticateAction();
        if ($user) {
            $access = $user->getAccesslevel();
            if ($access == 'Head' || $access == 'Admin') {
                $OpportunityID = $request->get('OpportunityID');
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('ridwanEntityBundle:Opportunity');
                $Opportunity = $repository->find($OpportunityID);
                $Opportunity->setEndtimestamp(new \DateTime());
                $Opportunity->setCompleted(1);
                $OpportunityRating = $request->get('rating');
                $OpportunityWeight = $Opportunity->getWeight();
                $Opportunity->setRate($OpportunityRating);

                $NotificationRepository = $em->getRepository('ridwanEntityBundle:Notification');
                $NotificationsQuery = $NotificationRepository->createQueryBuilder('p')
                    ->where('p.userid = :id AND p.seen = 0')
                    ->setParameter('id', $user->getId())
                    ->setMaxResults(10)
                    ->orderBy('p.id', 'DESC')
                    ->getQuery();
                $Notifications = $NotificationsQuery->getResult();

                $CareerRepository = $em->getRepository('ridwanEntityBundle:Trackreport');
                $userCareer = $CareerRepository->findOneBy(array('user' => $Opportunity->getUser()));
                $currentRating = $userCareer->getOverallrating();
                $totalWeight = $userCareer->getTotalWeight();
                $newRating
                    = (($currentRating * $totalWeight) + ($OpportunityRating * $OpportunityWeight)) / ($totalWeight + $OpportunityWeight);

                $userCareer->setOverallrating($newRating);
                $userCareer->setTotalweight($totalWeight + $OpportunityWeight);

                $feedbacks = $userCareer->getComments();
                if ($feedbacks == null) {
                    $feedbacks = array();
                }
                $feedbacks[] = array($Opportunity->getLeader(), $request->get('feedback'));
                $userCareer->setComments($feedbacks);

                try {
                    $em->persist($userCareer);
                    $em->persist($Opportunity);
                    $em->flush();
                } catch (\Exception $e) {
                    //echo $e;
                    return $this->redirect(
                        $this->generateUrl(
                            'ridwan_Opportunity_details', array(
                                'type' => 'E',
                                'message' => " opz! somethings went wrong!",
                                'OpportunityID' => $OpportunityID
                            )
                        )
                    );
                }

                $this->setNotification(
                    'Opportunity Completed',
                    "Congratulations! You have completed your Opportunity with a Rating of " . $OpportunityRating . "/10.", 3,
                    $Opportunity->getUser(), $Opportunity->getId(), $Opportunity->getProject()
                );


                return $this->redirect(
                    $this->generateUrl(
                        'ridwan_Opportunity_details', array(
                            'type' => 'S',
                            'message' => " successfully saved changes and notified user",
                            'OpportunityID' => $OpportunityID
                        )
                    )
                );
            } else {
                return $this->render(
                    'ridwanStyleBundle:Error:permission.html.twig');
            }
        }
        return $this->redirect($this->generateUrl('ridwan_site_login'));
    }

    public function newOpportunityAction(Request $request)
    {
        $user = $this->getUser();
        if ($user) {
            $access = $user->getRoles()[0];
            $em = $this->getDoctrine()->getManager();
            if ($access == 'ORGANIZATION') {
                $Opportunity = new Opportunities();
                $form = $this->createForm(
                    new OpportunitiesType(), $Opportunity, array(
                        'action' => $this->generateUrl('ridwan_opportunity_new'),
                        'attr' => array(
                            'class' => 'form-horizontal center'

                        )
                    )
                );
                $form->handleRequest($request);

                if ($form->isValid()) {

                    $Opportunity = $form->getData();
                    $Opportunity->setOrganization($this->getOrganization()->getId());
                    $Opportunity->setStatus(0);
                    $profession = $Opportunity->getRole()->getSelection();
                    $location = $Opportunity->getLocation()->getPlace();
                    $Opportunity->setLocation($location);
                    $Opportunity->setRole($profession);
                    $em->persist($Opportunity);

                    try {
                        $em->flush();
                    } catch (\Exception $e) {
                        echo $e;
                        return $this->render(
                            'RidwanOpportunityBundle:Opportunities:new.html.twig', array(
                                'message' => ' Opz! something went wrong!',
                                'type' => 'E',
                                'form' => $form->createView(),
                            )
                        );
                    }

                    return $this->redirect(
                        $this->generateUrl(
                            'ridwan_opportunity_index', array(
                                'type' => 'S',
                                'message' => "request sent to authorities"
                            )
                        )
                    );
                }

                return $this->render(
                    'RidwanOpportunityBundle:Opportunities:new.html.twig', array(
                        'form' => $form->createView(),

                    )
                );
            } else {
                return $this->render(
                    'RidwanSiteBundle:Error:permission.html.twig', array(

                    )
                );
            }
        }
        return $this->redirect($this->generateUrl('ridwan_site_loginpage'));
    }


    public function deleteOpportunityAction(Request $request)
    {
        $user = $this->authenticateAction();
        if ($user) {
            $access = $user->getAccesslevel();

            $em = $this->getDoctrine()->getManager();
            $NotificationRepository = $em->getRepository('ridwanEntityBundle:Notification');
            $NotificationsQuery = $NotificationRepository->createQueryBuilder('p')
                ->where('p.userid = :id AND p.seen = 0')
                ->setParameter('id', $user->getId())
                ->setMaxResults(10)
                ->orderBy('p.id', 'DESC')
                ->getQuery();
            $Notifications = $NotificationsQuery->getResult();
            if ($access == 'Head' || $access == 'Admin') {
                $id = $request->get('id');
                $Opportunity = $em->getRepository('ridwanEntityBundle:Opportunity')->find($id);
                $Comments = $em->getRepository('ridwanEntityBundle:Comments')->findBy(array("Opportunity" => $id));
                if ($Comments != null) {
                    foreach ($Comments as $comment) {
                        $em->remove($comment);
                    }
                }

                $Notifications = $em->getRepository('ridwanEntityBundle:Notification')->findBy(array("Opportunity" => $id));

                if ($Notifications != null) {
                    foreach ($Notifications as $notification) {
                        $em->remove($notification);
                    }
                }
                if (!$Opportunity) {
                    return $this->redirect(
                        $this->generateUrl(
                            'ridwan_Opportunity_index', array(
                                'type' => 'E',
                                'message' => " opz! could not find Opportunity"
                            )
                        )
                    );
                }

                try {

                    $em->remove($Opportunity);
                    $em->flush();
                } catch (\Exception $e) {
                    return $this->redirect(
                        $this->generateUrl(
                            'ridwan_Opportunity_index', array(
                                'type' => 'E',
                                'message' => " opz! could not delete Opportunity"
                            )
                        )
                    );
                }


                return $this->redirect(
                    $this->generateUrl(
                        'ridwan_Opportunity_index', array(
                            'type' => 'S',
                            'message' => " successfully deleted the Opportunity"
                        )
                    )
                );
            } else {
                return $this->render(
                    'ridwanStyleBundle:Error:permission.html.twig', array(
                        'Notifications' => $Notifications
                    )
                );
            }
        }
        return $this->redirect($this->generateUrl('ridwan_site_login'));
    }

    private function setNotification($heading, $message, $type, $user, $Opportunity, $project)
    {
        $em = $this->getDoctrine()->getManager();
        $notification = new Notification();
        $notification->setOpportunity($Opportunity);
        $notification->setHeading($heading);
        $notification->setDetails($message);
        $notification->setProject($project);
        $notification->setSeen(0);
        $notification->setTimestamp(new \DateTime());
        $notification->setType($type);
        $notification->setUserid($user);
        $em->persist($notification);
        $em->flush();
    }

    private function sendEmailAction($email, $name, $OpportunityID)
    {


        $link = "http://www.volma.ridwan.com" . $this->generateUrl('ridwan_Opportunity_details', array('OpportunityID' => $OpportunityID));


        // echo "Got Here ".$username." ".$firstname;
        $message = \Swift_Message::newInstance()
            ->setSubject('New Opportunity Assigned')
            ->setFrom('ridwan@gmail.com')
            ->setTo($email)
            ->setBcc('rshariffdeen@gmail.com')
            ->setBody(
                $this->renderView(
                    'ridwanNotificationBundle:Opportunity:notification.html.twig', array('name' => $name, 'link' => $link)
                ), 'text/html'
            );
        $this->get('mailer')->send($message);
    }

    public function notificationAction($OpportunityID, $notificationID)
    {
        $user = $this->authenticateAction();
        if ($user) {
            $em = $this->getDoctrine()->getManager();
            $Repository = $em->getRepository('ridwanEntityBundle:Notification');
            $notification = $Repository->find($notificationID);
            $notification->setSeen(1);
            $em->persist($notification);
            $em->flush();

            return $this->redirect($this->generateUrl('ridwan_Opportunity_details', array('OpportunityID' => $OpportunityID)));
        }
    }

}