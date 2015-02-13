<?php

namespace Ridwan\NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ridwan\EntityBundle\Entity\Notification;

class NotificationController extends Controller
{
    public function seenAction($notificationID)
    {
        $em = $this->getDoctrine()->getManager();
        $Repository = $em->getRepository('RidwanEntityBundle:Notification');
        $notification = $Repository->find($notificationID);
        $notification->setSeen(1);
        $em->persist($notification);
        $em->flush();
        
        return $this->redirect($this->generateUrl('ridwan_homepage'));
    }
    
    public function showAllAction(){
    	$session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('RidwanEntityBundle:User');
        $id = $session->get('user');
        $user = $repository->findOneBy(array('id' => $id));
        $NotificationRepository = $em->getRepository('RidwanEntityBundle:Notification');
        $NotificationsQuery = $NotificationRepository->createQueryBuilder('p')
                    ->where('p.userid = :id AND p.seen = 0')
                    ->setParameter('id', $user->getId())
                    ->setMaxResults(10)
                    ->orderBy('p.id', 'DESC')
                    ->getQuery();
            $Notifications = $NotificationsQuery->getResult();
       $AllNotificationsQuery = $NotificationRepository->createQueryBuilder('p')
                    ->where('p.userid = :id')
                    ->setParameter('id', $user->getId())
                    ->setMaxResults(10)
                    ->orderBy('p.id', 'DESC')
                    ->getQuery();
            $AllNotifications = $AllNotificationsQuery->getResult();
    	return $this->render('RidwanNotificationBundle:Task:allnotification.html.twig',array(
    		'Notifications' => $Notifications,
    		'AllNotifications' => $AllNotifications
    	));
    }
}