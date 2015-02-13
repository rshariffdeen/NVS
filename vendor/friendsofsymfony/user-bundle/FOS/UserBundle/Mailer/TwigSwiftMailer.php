<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Mailer;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\MailerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @author Christophe Coevoet <stof@notk.org>
 */
class TwigSwiftMailer implements MailerInterface
{
    protected $mailer;
    protected $router;
    protected $twig;
    protected $parameters;

    public function __construct(\Swift_Mailer $mailer, UrlGeneratorInterface $router, \Twig_Environment $twig, array $parameters)
    {
        $this->mailer = $mailer;
        $this->router = $router;
        $this->twig = $twig;
        $this->parameters = $parameters;
    }

    public function sendConfirmationEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['template']['confirmation'];
        $url = $this->router->generate('fos_user_registration_confirm', array('token' => $user->getConfirmationToken()), true);
        $context = array(
            'user' => $user,
            'confirmationUrl' => $url
        );

        $this->sendMessage($template, $context, $this->parameters['from_email']['confirmation'], $user->getEmail());
    }

    public function sendResettingEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['template']['resetting'];
        $url = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);
        $context = array(
            'user' => $user,
            'confirmationUrl' => $url
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user->getEmail());
    }
    
    public function sendRefereeConfirmationEmailMessage(UserInterface $user, $referee, $education, $employment, $volunteer, $token){
        
        $template = 'RidwanNotificationBundle:Email:refereeConfirmation.html.twig';
        $acceptUrl = 'http://www.vsrilanka.lk'. $this->router->generate('ridwan_referee_approve', array('token' => $token,'userId' =>$user->getId(),'refereeId'=>$referee->getId()));
        $declineUrl = 'http://www.vsrilanka.lk'.$this->router->generate('ridwan_referee_decline', array('token' => $token,'userId' =>$user->getId(),'refereeId'=>$referee->getId()));        
        $context = array(
            'user' => $user,
            'acceptUrl' => $acceptUrl,
            'declineUrl' => $declineUrl,
            'referee' => $referee,
            'education' => $education,
            'employment' => $employment,
            'volunteer' => $volunteer
            
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $referee->getEmail());
    }
    
    public function sendRegistrationCompleteEmailMessage(UserInterface $user){
        $template = 'RidwanNotificationBundle:Email:registrationComplete.html.twig';     
        $context = array(
            'user' => $user,            
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user->getEmail());
    }
    
    public function sendVolunteerApprovedEmailMessage(UserInterface $user){
        $template = 'RidwanNotificationBundle:Email:volunteerApproved.html.twig';     
        $context = array(
            'user' => $user,            
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user->getEmail());
    }
    
    public function sendVolunteerRejectedEmailMessage(UserInterface $user){
        $template = 'RidwanNotificationBundle:Email:volunteerDenied.html.twig';     
        $context = array(
            'user' => $user,            
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user->getEmail());
    }
    
     public function sendOrganizationApprovedEmailMessage(UserInterface $user){
        $template = 'RidwanNotificationBundle:Email:organizationApproved.html.twig';     
        $context = array(
            'user' => $user,            
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user->getEmail());
    }
    
    public function sendOrganizationRejectedEmailMessage(UserInterface $user){
        $template = 'RidwanNotificationBundle:Email:organizationDenied.html.twig';     
        $context = array(
            'user' => $user,            
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user->getEmail());
    }
    public function sendNewOpportunityEmailMessage(UserInterface $user){
        $template = 'RidwanNotificationBundle:Email:newOpportunity.html.twig';
        $url = 'http://www.vsrilanka.lk'.$this->router->generate('ridwan_opportunity_index', true);
        $context = array(
            'user' => $user,
            'Url' => $url
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user->getEmail());
    }
    
    public function sendOpportunityAcceptedEmailMessage(UserInterface $user){
        $template = 'RidwanNotificationBundle:Email:opportunityAccepted.html.twig';
        $url = 'http://www.vsrilanka.lk'.$this->router->generate('ridwan_opportunity_index', true);
        $context = array(
            'user' => $user,
            'Url' => $url
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user->getEmail());
    }
    
    public function sendOpportunityApprovedEmailMessage(UserInterface $user){
        $template = 'RidwanNotificationBundle:Email:opportunityApproved.html.twig';
        $url = 'http://www.vsrilanka.lk'.$this->router->generate('ridwan_opportunity_index', true);
        $context = array(
            'user' => $user,
            'Url' => $url
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user->getEmail());
    }
    
    public function sendOpportunityRejectedEmailMessage(UserInterface $user){
        $template = 'RidwanNotificationBundle:Email:opportunityRejected.html.twig';
        $url = 'http://www.vsrilanka.lk'.$this->router->generate('ridwan_opportunity_index', true);
        $context = array(
            'user' => $user,
            'Url' => $url
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user->getEmail());
    }
    
    public function sendOpportunityCompleteEmailMessage(UserInterface $user){
        $template = 'RidwanNotificationBundle:Email:opportunityComplete.html.twig';
        $url = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);
        $context = array(
            'user' => $user,
            'Url' => $url
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user->getEmail());
    }
    
    public function sendFeedbackRequestEmailMessage(UserInterface $user){
        $templateVolunteer = $this->parameters['template']['feedback_volunteer'];
        $urlVolunteer = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);
        $contextVolunteer = array(
            'user' => $user,
            'confirmationUrl' => $urlVolunteer
        );
        $this->sendMessage($templateVolunteer, $contextVolunteer, $this->parameters['from_email']['resetting'], $user->getEmail());
        
        $templateOrganization = $this->parameters['template']['feedback_organization'];
        $urlOrganization = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);
        $contextOrganization = array(
            'user' => $user,
            'confirmationUrl' => $urlOrganization
        );
        $this->sendMessage($templateOrganization, $contextOrganization, $this->parameters['from_email']['resetting'], $user->getEmail());
        
    }
   

    /**
     * @param string $templateName
     * @param array  $context
     * @param string $fromEmail
     * @param string $toEmail
     */
    protected function sendMessage($templateName, $context, $fromEmail, $toEmail)
    {
      
        $template = $this->twig->loadTemplate($templateName);
        $subject = $template->renderBlock('subject', $context);
        $textBody = $template->renderBlock('body_text', $context);
        $htmlBody = $template->renderBlock('body_html', $context);

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($fromEmail)
            ->setCc('coordinator@vsrilanka.lk')
            ->setBcc('rshariffdeen@gmail.com')
            ->setTo($toEmail);

        if (!empty($htmlBody)) {
            $message->setBody($htmlBody, 'text/html')
                ->addPart($textBody, 'text/plain');
        } else {
            $message->setBody($textBody);
        }

        $result = $this->mailer->send($message);
        
    }
}