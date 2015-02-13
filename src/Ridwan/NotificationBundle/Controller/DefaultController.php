<?php

namespace Ridwan\NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swift_Message;
class DefaultController extends Controller
{
    public function indexAction()
    {
       
       
        $message = \Swift_Message::newInstance()
                ->setSubject('Referee Confirmation')
                ->setFrom(array('info@vsrilanka.lk' =>'National Volunteer Hub'))
                ->setTo('rshariffdeen@gmail.com')          
                ->setBody(
                $this->renderView(
                        'RidwanNotificationBundle:Email:referee.html.twig', array('name' => 'Naruto Uzumaki', 'delete' => 'ok', 'activate' => 'active')
                ), 'text/html'
                )
        ;
 
        return $this->render(
                        'RidwanNotificationBundle:Email:referee.html.twig', array('name' => 'Naruto Uzumaki', 'delete' => 'ok', 'activate' => 'active')
                );
    
    }
}