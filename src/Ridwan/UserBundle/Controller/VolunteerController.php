<?php

namespace Ridwan\UserBundle\Controller;


use Ridwan\EntityBundle\Entity\RefereeAndUser;
use Ridwan\EntityBundle\Form\RefereeAndUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ridwan\EntityBundle\Entity\Volunteerpersonal;
use Ridwan\EntityBundle\Form\VolunteerpersonalType;
use Ridwan\EntityBundle\Entity\Education;
use Ridwan\EntityBundle\Form\EducationType;
use Ridwan\EntityBundle\Entity\Volunteercontactdetails;
use Ridwan\EntityBundle\Form\VolunteercontactdetailsType;
use Ridwan\EntityBundle\Entity\Employment;
use Ridwan\EntityBundle\Form\EmploymentType;
use Ridwan\EntityBundle\Entity\Skills;
use Ridwan\EntityBundle\Form\SkillsType;
use Ridwan\EntityBundle\Entity\Referees;
use Ridwan\EntityBundle\Form\RefereesType;
use Ridwan\EntityBundle\Entity\Profile;
use Ridwan\EntityBundle\Entity\Availability;
use Symfony\Component\HttpFoundation\Request;


class VolunteerController extends Controller
{

    public function welcomeAction(Request $request)
    {

        if ($this->check('RidwanEntityBundle:Volunteerpersonal') == null) {
            return $this->PersonalAction(new Request());
        }

        if ($this->check('RidwanEntityBundle:Volunteercontactdetails') == null) {
            return $this->ContactAction(new Request());
        }
        if ($this->check('RidwanEntityBundle:Education') == null) {
            return $this->EducationAction(new Request());
        }
        if ($this->check('RidwanEntityBundle:Employment') == null) {
            return $this->EmploymentAction(new Request());
        }
        if ($this->check('RidwanEntityBundle:Skills') == null) {
            return $this->SkillsAction(new Request());
        }
        if ($this->check('RidwanEntityBundle:RefereeAndUser') == null) {
            return $this->RefereesAction(new Request());
        }


        return $this->render('RidwanUserBundle:Welcome:completed.html.twig');

    }

    private function check($repositoryname)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository($repositoryname);
        return $repository->findOneBy(array("user" => $this->getUser()));
    }


    public function PersonalAction(Request $request)
    {
        if ($this->check('RidwanEntityBundle:Volunteerpersonal') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }
        $volunteer = new Volunteerpersonal();
        $form = $this->createForm(
            new VolunteerpersonalType(), $volunteer, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_personal'),
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );
        $form->handleRequest($request);
        if ($form->isValid()) {
            $volunteer = $form->getData();
            $volunteer->setStatus(0);
            $volunteer->setUser($this->getUser());
            $nationality = $volunteer->getNationality();
            $volunteer->setNationality($nationality->getName());
            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($volunteer);
                $em->flush();
            } catch (\Exception $e) {
               // echo $e;
                return $this->render(
                    'RidwanUserBundle:Welcome:personal.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'E',
                        'message' => 'Duplicate Entry for Identification',
                        'details' => $e->getMessage()
                    )
                );

            }

            return $this->contactAction(new Request());

        }

        return $this->render(
            'RidwanUserBundle:Welcome:personal.html.twig', array(
                'form' => $form->createView()
            )
        );


    }

    public function EducationAction(Request $request)
    {
        if ($this->check('RidwanEntityBundle:Education') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }

        $em = $this->getDoctrine()->getManager();
        $qualifications = $em->getRepository('RidwanEntityBundle:Education')->findBy(array('user'=>$this->getUser()->getId()));
        $education = new Education();
        $form = $this->createForm(
            new EducationType(), $education, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_education'),
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );

        $form->handleRequest($request);
        if ($form->isValid()) {
            $education = $form->getData();
            $education->setUser($this->getUser());
            try {
                $em->persist($education);
                $em->flush();
            } catch (\Exception $e) {
                return $this->render(
                    'RidwanUserBundle:Welcome:education.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'E',
                        'message' => 'opz! something is wrong!',
                        'details' => $e->getMessage(),
                        'qualifications' => $qualifications
                    )
                );
            }
            $qualifications = $em->getRepository('RidwanEntityBundle:Education')->findBy(array('user'=>$this->getUser()->getId()));

            return $this->render(
                'RidwanUserBundle:Welcome:education.html.twig', array(
                    'form' => $form->createView(),
                    'qualifications' => $qualifications
                )
            );

        }

        return $this->render(
            'RidwanUserBundle:Welcome:education.html.twig', array(
                'form' => $form->createView(),
                'qualifications' => $qualifications
            )
        );


    }

    public function EmploymentAction(Request $request)
    {
        if ($this->check('RidwanEntityBundle:Employment') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }

        $em = $this->getDoctrine()->getManager();
        $history = $em->getRepository('RidwanEntityBundle:Employment')->findBy(array('user'=>$this->getUser()->getId()));
        $employment = new Employment();
        $form = $this->createForm(
            new EmploymentType(), $employment, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_employment'),
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );

        $form->handleRequest($request);
        if ($form->isValid()) {
            $employment = $form->getData();
            $employment->setUser($this->getUser());
            try {
                $em->persist($employment);
                $em->flush();
            } catch (\Exception $e) {
                return $this->render(
                    'RidwanUserBundle:Welcome:employment.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'E',
                        'message' => 'opz! something is wrong!',
                        'details' => $e->getMessage(),
                        'history' => $history
                    )
                );
            }
            $history = $em->getRepository('RidwanEntityBundle:Employment')->findBy(array('user'=>$this->getUser()->getId()));

            return $this->render(
                'RidwanUserBundle:Welcome:employment.html.twig', array(
                    'form' => $form->createView(),
                    'history' => $history
                )
            );

        }

        return $this->render(
            'RidwanUserBundle:Welcome:employment.html.twig', array(
                'form' => $form->createView(),
                'history' => $history
            )
        );


    }

    public function contactAction(Request $request)
    {

        if ($this->check('RidwanEntityBundle:Volunteercontactdetails') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }

        $contacts = new Volunteercontactdetails();

        $form = $this->createForm(
            new VolunteercontactdetailsType(), $contacts, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_contacts'),
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $contacts = $form->getData();
            $contacts->setUser($this->getUser());
            $location = $contacts->getDivisionalsecretary();
            $contacts->setDivisionalsecretary($location->getDivision());
            $contacts->setDistrict($location->getDistrict());
            $contacts->setProvince($location->getProvince());
            $em = $this->getDoctrine()->getManager();
            try {
                $em->persist($contacts);
                $em->flush();
            } catch (\Exception $e) {
                return $this->render(
                    'RidwanUserBundle:Welcome:contact.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'E',
                        'message' => 'opz! something is wrong!',
                        'details' => $e->getMessage()

                    )
                );

            }

            return $this->educationAction($request);

        }


        return $this->render(
            'RidwanUserBundle:Welcome:contact.html.twig', array(
                "form" => $form->createView()
            )
        );


    }

    public function SkillsAction(Request $request)
    {
        if ($this->check('RidwanEntityBundle:Skills') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }
        $skills = new Skills();
        $form = $this->createForm(
            new SkillsType(), $skills, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_skills'),
                'attr' => array(
                    'class' => 'ac-custom ac-checkbox ac-cross  ac-fill'
                )
            )
        );
        $form->handleRequest($request);
        if ($form->isValid()) {
            $skills = $form->getData();
            $em = $this->getDoctrine()->getManager();
            try {
                $strprimary = $skills->getPrimary()->getSelection();
                //echo $strprimary;
                $skills->setPrimary($strprimary);
                $strsecondary = $skills->getSecondary()->getSelection();
                //echo $strsecondary;
                $skills->setSecondary($strsecondary);
                $skills->setUser($this->getUser());
                $em->persist($skills);
                $em->flush();
            } catch (\Exception $e) {
                //echo $e->getMessage();
                return $this->render(
                    'RidwanUserBundle:Welcome:skills.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'E',
                        'message' => $e->getMessage(),
                        'details' => $e->getMessage()

                    )
                );
            }

            return $this->RefereesAction($request);
        }

        return $this->render(
            'RidwanUserBundle:Welcome:skills.html.twig', array(
                'form' => $form->createView()
            )
        );
    }

    public function RefereesAction(Request $request)
    {
        if ($this->check('RidwanEntityBundle:RefereeAndUser') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }

        $em = $this->getDoctrine()->getManager();
        

        $referee1 = new Referees();
        $referee2 = new Referees();

        $entity = new RefereeAndUser();
        $entity->getReferees()->add($referee1);
        $entity->getReferees()->add($referee2);

        $form = $this->createForm(
            new RefereeAndUserType(), $entity, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_referees'),
                'method' => 'POST',
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );


        $form->handleRequest($request);
        if ($form->isValid()) {
            $entity = $form->getData();
            $entity->setUser($this->getUser());
            $referee1 = $entity->getReferees()[0];
            $referee2 = $entity->getReferees()[1];
            $referee1->setUser($this->getUser()->getId());
            $referee2->setUser($this->getUser()->getId());
            $em->persist($referee1);
            $em->persist($referee2);            
            
            
            $refereeUserRecordOne = new RefereeAndUser();
            $refereeUserRecordOne->setUser($this->getUser());
            $refereeUserRecordOne->setReferee($referee1);
            $refereeUserRecordOne->setToken(hash('sha256',rand(10000, 99999)));
            $refereeUserRecordOne->setStatus(0);
            $em->persist($refereeUserRecordOne);            
            
            $refereeUserRecordTwo = new RefereeAndUser();
            $refereeUserRecordTwo->setUser($this->getUser());
            $refereeUserRecordTwo->setReferee($referee2);
            $refereeUserRecordTwo->setToken(hash('sha256',rand(10000, 99999)));
            $refereeUserRecordTwo->setStatus(0);
            $em->persist($refereeUserRecordTwo);
            $em->flush();
            
            
            $volunteer = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->findOneBy(array('user'=>$this->getUser()->getId()));
            $volunteer->setStatus(1);
            $em->persist($volunteer);

            $profile = new Profile();
            $profile->setUser($this->getUser());
            $profile->setAggregatedRating(0);
            $profile->setTotalWeight(0);
            $profile->setHours(0);
            $profile->setValue(0);
            $profile->setCurrent(0);

            $availability = new Availability();
            $availability->setUser($this->getUser());
            $em->persist($availability);            
            $em->persist($profile);
            
            
            $this->sendRefereeEmailAction($this->getUser()->getId());
            $this->sendRegistrationCompleteEmailAction($this->getUser()->getId());            
            $em->flush();
            
            return $this->render('RidwanUserBundle:Welcome:completed.html.twig');
        }

        return $this->render(
            'RidwanUserBundle:Welcome:referees.html.twig', array(
                //'database' => $database,
                'form' => $form->createView()
            )
        );

    }
    
    
      /**
     * Send referee email
     */
    public function sendRefereeEmailAction($userId)
    {
    	//const SESSION_EMAIL = 'referee_send_confirmation_email/email';
    
        $em = $this->getDoctrine()->getManager(); 
        
        $userRefereeList = $em->getRepository('RidwanEntityBundle:RefereeAndUser')->findBy(array('user'=>$userId));
        $employmentRepository = $em->getRepository('RidwanEntityBundle:Employment');
        $educationRepository = $em->getRepository('RidwanEntityBundle:Education');
        $refereesRepository = $em->getRepository('RidwanEntityBundle:Referees');
        $authRepository = $em->getRepository('RidwanEntityBundle:Authentication');
        $volunteerRepository = $em->getRepository('RidwanEntityBundle:Volunteerpersonal');
                
        foreach($userRefereeList as $userReferee){
         
                    $referee = $refereesRepository->find($userReferee->getReferee());
                    $userId = $this->getUser()->getId();
                    $employmentDetails = $employmentRepository->findBy(array('user'=>$userId));
        	    $educationDetails = $educationRepository->findBy(array('user'=>$userId)); 
        	    $personalDetails = $volunteerRepository->findOneBy(array('user'=>$userId)); 
        	    $user = $authRepository->find($userReferee->getUser()); 
        	    
        	
        	    /** @var $user UserInterface */
                    //$user = $this->container->get('fos_user.user_manager')->findUserByUsernameOrEmail($auth->getUsername());
                    
        	   // $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
                   $result = $this->container->get('fos_user.mailer')->sendRefereeConfirmationEmailMessage($user, $referee, $educationDetails, $employmentDetails, $personalDetails,$userReferee->getToken());           	   
	          
        }
       // echo "email: " . $result;
        
      
        return true;    
          
    }
    
    
     /**
     * Send user registration complete email message
     */
    public function sendRegistrationCompleteEmailAction($userId)
    {
        //const SESSION_EMAIL = 'volunteer_send_complete_email/email';
    
        $em = $this->getDoctrine()->getManager();         
        $authRepository = $em->getRepository('RidwanEntityBundle:Authentication');   
        //$userId = $this->getUser()->getId();                   
        $user = $authRepository->find($userId); 
       // $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
        $result = $this->container->get('fos_user.mailer')->sendRegistrationCompleteEmailMessage($user);
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



<?php

namespace Ridwan\UserBundle\Controller;


use Ridwan\EntityBundle\Entity\RefereeAndUser;
use Ridwan\EntityBundle\Form\RefereeAndUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ridwan\EntityBundle\Entity\Volunteerpersonal;
use Ridwan\EntityBundle\Form\VolunteerpersonalType;
use Ridwan\EntityBundle\Entity\Education;
use Ridwan\EntityBundle\Form\EducationType;
use Ridwan\EntityBundle\Entity\Volunteercontactdetails;
use Ridwan\EntityBundle\Form\VolunteercontactdetailsType;
use Ridwan\EntityBundle\Entity\Employment;
use Ridwan\EntityBundle\Form\EmploymentType;
use Ridwan\EntityBundle\Entity\Skills;
use Ridwan\EntityBundle\Form\SkillsType;
use Ridwan\EntityBundle\Entity\Referees;
use Ridwan\EntityBundle\Form\RefereesType;
use Ridwan\EntityBundle\Entity\Profile;
use Ridwan\EntityBundle\Entity\Availability;
use Symfony\Component\HttpFoundation\Request;


class VolunteerController extends Controller
{

    public function welcomeAction(Request $request)
    {

        if ($this->check('RidwanEntityBundle:Volunteerpersonal') == null) {
            return $this->PersonalAction(new Request());
        }

        if ($this->check('RidwanEntityBundle:Volunteercontactdetails') == null) {
            return $this->ContactAction(new Request());
        }
        if ($this->check('RidwanEntityBundle:Education') == null) {
            return $this->EducationAction(new Request());
        }
        if ($this->check('RidwanEntityBundle:Employment') == null) {
            return $this->EmploymentAction(new Request());
        }
        if ($this->check('RidwanEntityBundle:Skills') == null) {
            return $this->SkillsAction(new Request());
        }
        if ($this->check('RidwanEntityBundle:RefereeAndUser') == null) {
            return $this->RefereesAction(new Request());
        }


        return $this->render('RidwanUserBundle:Welcome:completed.html.twig');

    }

    private function check($repositoryname)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository($repositoryname);
        return $repository->findOneBy(array("user" => $this->getUser()));
    }


    public function PersonalAction(Request $request)
    {
        if ($this->check('RidwanEntityBundle:Volunteerpersonal') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }
        $volunteer = new Volunteerpersonal();
        $form = $this->createForm(
            new VolunteerpersonalType(), $volunteer, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_personal'),
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );
        $form->handleRequest($request);
        if ($form->isValid()) {

            $volunteer = $form->getData();
            $volunteer->setStatus(0);
            $volunteer->setUser($this->getUser());

            $nationality = $volunteer->getNationality();
            $volunteer->setNationality($nationality->getName());
            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($volunteer);
                $em->flush();
            } catch (\Exception $e) {
                echo $e;
                return $this->render(
                    'RidwanUserBundle:Welcome:personal.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'E',
                        'message' => 'Duplicate Entry for Identification',
                        'details' => $e->getMessage()
                    )
                );

            }

            return $this->contactAction(new Request());

        }

        return $this->render(
            'RidwanUserBundle:Welcome:personal.html.twig', array(
                'form' => $form->createView()
            )
        );


    }

    public function EducationAction(Request $request)
    {
        if ($this->check('RidwanEntityBundle:Education') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }

        $em = $this->getDoctrine()->getManager();
        $qualifications = $em->getRepository('RidwanEntityBundle:Education')->findBy(array('user'=>$this->getUser()->getId()));
        $education = new Education();
        $form = $this->createForm(
            new EducationType(), $education, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_education'),
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );

        $form->handleRequest($request);
        if ($form->isValid()) {
            $education = $form->getData();
            $education->setUser($this->getUser());
            try {
                $em->persist($education);
                $em->flush();
            } catch (\Exception $e) {
                return $this->render(
                    'RidwanUserBundle:Welcome:education.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'E',
                        'message' => 'opz! something is wrong!',
                        'details' => $e->getMessage(),
                        'qualifications' => $qualifications
                    )
                );
            }
            $qualifications = $em->getRepository('RidwanEntityBundle:Education')->findBy(array('user'=>$this->getUser()->getId()));

            return $this->render(
                'RidwanUserBundle:Welcome:education.html.twig', array(
                    'form' => $form->createView(),
                    'qualifications' => $qualifications
                )
            );

        }

        return $this->render(
            'RidwanUserBundle:Welcome:education.html.twig', array(
                'form' => $form->createView(),
                'qualifications' => $qualifications
            )
        );


    }

    public function EmploymentAction(Request $request)
    {
        if ($this->check('RidwanEntityBundle:Employment') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }

        $em = $this->getDoctrine()->getManager();
        $history = $em->getRepository('RidwanEntityBundle:Employment')->findBy(array('user'=>$this->getUser()->getId()));
        $employment = new Employment();
        $form = $this->createForm(
            new EmploymentType(), $employment, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_employment'),
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );

        $form->handleRequest($request);
        if ($form->isValid()) {
            $employment = $form->getData();
            $employment->setUser($this->getUser());
            try {
                $em->persist($employment);
                $em->flush();
            } catch (\Exception $e) {
                return $this->render(
                    'RidwanUserBundle:Welcome:employment.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'E',
                        'message' => 'opz! something is wrong!',
                        'details' => $e->getMessage(),
                        'history' => $history
                    )
                );
            }
            $history = $em->getRepository('RidwanEntityBundle:Employment')->findBy(array('user'=>$this->getUser()->getId()));

            return $this->render(
                'RidwanUserBundle:Welcome:employment.html.twig', array(
                    'form' => $form->createView(),
                    'history' => $history
                )
            );

        }

        return $this->render(
            'RidwanUserBundle:Welcome:employment.html.twig', array(
                'form' => $form->createView(),
                'history' => $history
            )
        );


    }

    public function contactAction(Request $request)
    {

        if ($this->check('RidwanEntityBundle:Volunteercontactdetails') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }

        $contacts = new Volunteercontactdetails();

        $form = $this->createForm(
            new VolunteercontactdetailsType(), $contacts, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_contacts'),
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $contacts = $form->getData();
            $contacts->setUser($this->getUser());
            $location = $contacts->getDivisionalsecretary();
            $contacts->setDivisionalsecretary($location->getDivision());
            $contacts->setDistrict($location->getDistrict());
            $contacts->setProvince($location->getProvince());
            $em = $this->getDoctrine()->getManager();
            try {
                $em->persist($contacts);
                $em->flush();
            } catch (\Exception $e) {
                return $this->render(
                    'RidwanUserBundle:Welcome:contact.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'E',
                        'message' => 'opz! something is wrong!',
                        'details' => $e->getMessage()

                    )
                );

            }

            return $this->educationAction($request);

        }


        return $this->render(
            'RidwanUserBundle:Welcome:contact.html.twig', array(
                "form" => $form->createView()
            )
        );


    }

    public function SkillsAction(Request $request)
    {
        if ($this->check('RidwanEntityBundle:Skills') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }
        $skills = new Skills();
        $form = $this->createForm(
            new SkillsType(), $skills, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_skills'),
                'attr' => array(
                    'class' => 'ac-custom ac-checkbox ac-cross  ac-fill'
                )
            )
        );
        $form->handleRequest($request);
        if ($form->isValid()) {
            $skills = $form->getData();
            $em = $this->getDoctrine()->getManager();
            try {
                $strprimary = $skills->getPrimary()->getSelection();
                //echo $strprimary;
                $skills->setPrimary($strprimary);
                $strsecondary = $skills->getSecondary()->getSelection();
                //echo $strsecondary;
                $skills->setSecondary($strsecondary);
                $skills->setUser($this->getUser());
                $em->persist($skills);
                $em->flush();
            } catch (\Exception $e) {
                //echo $e->getMessage();
                return $this->render(
                    'RidwanUserBundle:Welcome:skills.html.twig', array(
                        'form' => $form->createView(),
                        'type' => 'E',
                        'message' => $e->getMessage(),
                        'details' => $e->getMessage()

                    )
                );
            }

            return $this->RefereesAction($request);
        }

        return $this->render(
            'RidwanUserBundle:Welcome:skills.html.twig', array(
                'form' => $form->createView()
            )
        );
    }

    public function RefereesAction(Request $request)
    {
        if ($this->check('RidwanEntityBundle:RefereeAndUser') != null) {
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }

        $em = $this->getDoctrine()->getManager();
        

        $referee1 = new Referees();
        $referee2 = new Referees();

        $entity = new RefereeAndUser();
        $entity->getReferees()->add($referee1);
        $entity->getReferees()->add($referee2);

        $form = $this->createForm(
            new RefereeAndUserType(), $entity, array(
                'action' => $this->generateUrl('ridwan_user_volunteer_referees'),
                'method' => 'POST',
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            )
        );


        $form->handleRequest($request);
        if ($form->isValid()) {
            $entity = $form->getData();
            $entity->setUser($this->getUser());
            $referee1 = $entity->getReferees()[0];
            $referee2 = $entity->getReferees()[1];
            $referee1->setUser($this->getUser()->getId());
            $referee2->setUser($this->getUser()->getId());
            $em->persist($referee1);
            $em->persist($referee2);            
            
            
            $refereeUserRecordOne = new RefereeAndUser();
            $refereeUserRecordOne->setUser($this->getUser());
            $refereeUserRecordOne->setReferee($referee1);
            $refereeUserRecordOne->setToken(hash('sha256',rand(10000, 99999)));
            $refereeUserRecordOne->setStatus(0);
            $em->persist($refereeUserRecordOne);            
            
            $refereeUserRecordTwo = new RefereeAndUser();
            $refereeUserRecordTwo->setUser($this->getUser());
            $refereeUserRecordTwo->setReferee($referee2);
            $refereeUserRecordTwo->setToken(hash('sha256',rand(10000, 99999)));
            $refereeUserRecordTwo->setStatus(0);
            $em->persist($refereeUserRecordTwo);
            $em->flush();
            
            
            $volunteer = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->findOneBy(array('user'=>$this->getUser()->getId()));
            $volunteer->setStatus(1);
            $em->persist($volunteer);

            $profile = new Profile();
            $profile->setUser($this->getUser());
            $profile->setAggregatedRating(0);
            $profile->setTotalWeight(0);
            $profile->setHours(0);
            $profile->setValue(0);
            $profile->setCurrent(0);

            $availability = new Availability();
            $availability->setUser($this->getUser());
            $em->persist($availability);            
            $em->persist($profile);
            
            
            $this->sendRefereeEmailAction($this->getUser()->getId());
            $this->sendRegistrationCompleteEmailAction($this->getUser()->getId());            
            $em->flush();
            
            return $this->render('RidwanUserBundle:Welcome:completed.html.twig');
        }

        return $this->render(
            'RidwanUserBundle:Welcome:referees.html.twig', array(
                'form' => $form->createView()
            )
        );

    }
    
    
      /**
     * Send referee email
     */
    public function sendRefereeEmailAction($userId)
    {
    	//const SESSION_EMAIL = 'referee_send_confirmation_email/email';
    
        $em = $this->getDoctrine()->getManager(); 
        
        $userRefereeList = $em->getRepository('RidwanEntityBundle:RefereeAndUser')->findBy(array('user'=>$userId));
        $employmentRepository = $em->getRepository('RidwanEntityBundle:Employment');
        $educationRepository = $em->getRepository('RidwanEntityBundle:Education');
        $refereesRepository = $em->getRepository('RidwanEntityBundle:Referees');
        $authRepository = $em->getRepository('RidwanEntityBundle:Authentication');
        $volunteerRepository = $em->getRepository('RidwanEntityBundle:Volunteerpersonal');
                
        foreach($userRefereeList as $userReferee){
         
                    $referee = $refereesRepository->find($userReferee->getReferee());
                    $userId = $this->getUser()->getId();
                    $employmentDetails = $employmentRepository->findBy(array('user'=>$userId));
        	    $educationDetails = $educationRepository->findBy(array('user'=>$userId)); 
        	    $personalDetails = $volunteerRepository->findOneBy(array('user'=>$userId)); 
        	    $user = $authRepository->find($userReferee->getUser()); 
        	    
        	
        	    /** @var $user UserInterface */
                    //$user = $this->container->get('fos_user.user_manager')->findUserByUsernameOrEmail($auth->getUsername());
                    
        	   // $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
                   $result = $this->container->get('fos_user.mailer')->sendRefereeConfirmationEmailMessage($user, $referee, $educationDetails, $employmentDetails, $personalDetails,$userReferee->getToken());           	   
	          
        }
       // echo "email: " . $result;
        
      
        return true;    
          
    }
    
    
     /**
     * Send user registration complete email message
     */
    public function sendRegistrationCompleteEmailAction($userId)
    {
        //const SESSION_EMAIL = 'volunteer_send_complete_email/email';
    
        $em = $this->getDoctrine()->getManager();         
        $authRepository = $em->getRepository('RidwanEntityBundle:Authentication');   
        //$userId = $this->getUser()->getId();                   
        $user = $authRepository->find($userId); 
       // $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
        $result = $this->container->get('fos_user.mailer')->sendRegistrationCompleteEmailMessage($user);
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
