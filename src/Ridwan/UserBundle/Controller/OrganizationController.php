<?php

namespace Ridwan\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ridwan\EntityBundle\Entity\Organization;
use Ridwan\EntityBundle\Entity\Organizationcontactdetails;
use Ridwan\EntityBundle\Form\OrganizationType;
use Ridwan\EntityBundle\Form\OrganizationcontactdetailsType;
use Symfony\Component\HttpFoundation\Request;

class OrganizationController extends Controller
{
    public function welcomeAction(Request $request){

        if ($this->check('RidwanEntityBundle:Organization') == null){
            return $this->DetailsAction(new Request());
        }

        if ($this->check('RidwanEntityBundle:Organizationcontactdetails') == null){
            return $this->ContactAction(new Request());
        }

        return $this->render('RidwanUserBundle:Welcome:completed.html.twig');

    }

    private function check($repositoryname)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository($repositoryname);
        return $repository->findOneBy(array("user" => $this->getUser()->getId()));
    }



    public  function DetailsAction (Request $request){
        if ($this->check('RidwanEntityBundle:Organization') != null){
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }
        $organization = new Organization();
        $form = $this->createForm(new OrganizationType(), $organization, array(
                'action' => $this->generateUrl('ridwan_organization_details'),
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            ));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $organization = $form->getData();
            $organization->setStatus(0);
            $organization->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            try {
                $em->persist($organization);
                $em->flush();
            } catch (\Exception $e) {
                echo $e;
                return $this->render('RidwanUserBundle:Welcome:organizationdetails.html.twig', array(
                        'form' =>$form->createView(),
                        'type' => 'E',
                        'message' => 'opz! something is wrong!',
                        'details' => $e->getMessage()

                    ));
            }
            return $this->contactAction(new Request());
        }
        return $this->render('RidwanUserBundle:Welcome:organizationdetails.html.twig', array(
                'form' =>$form->createView()
            ));
    }

    public function contactAction(Request $request){

        if ($this->check('RidwanEntityBundle:Organizationcontactdetails') != null){
            return $this->redirect($this->generateUrl('ridwan_site_home'));
        }
        $contacts = new Organizationcontactdetails();

        $form = $this->createForm(new OrganizationcontactdetailsType(), $contacts, array(
                'action' => $this->generateUrl('ridwan_organization_contact'),
                'attr' => array(
                    'class' => 'form-horizontal center'
                )
            ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $contacts = $form->getData();
            $contacts->setUser($this->getUser());
            $location = $contacts->getDivisionalsecretary();
            $contacts->setDivisionalsecretary($location->getDivision());
            $contacts->setDistrict($location->getDistrict());
            $contacts->setProvince($location->getProvince());
            $em = $this->getDoctrine()->getManager();

            $organization = $em->getRepository('RidwanEntityBundle:Organization')->findOneBy(array('user'=>$this->getUser()->getId()));
            try {
                $organization->setStatus(1);
                $contacts -> setUser($this->getUser());
                $contacts -> setOrganization($organization);
                $em->persist($organization);
                $em->persist($contacts);
                $em->flush();
            } catch (\Exception $e) {
                echo $e;
                return $this->render('RidwanUserBundle:Welcome:Organizationcontact.html.twig', array(
                        'form' =>$form->createView(),
                        'type' => 'E',
                        'message' => 'opz! something is wrong!',
                        'details' => $e->getMessage()
                    ));
            }
            return $this->render('RidwanUserBundle:Welcome:completed.html.twig');
        }

        return $this->render('RidwanUserBundle:Welcome:Organizationcontact.html.twig', array(
                "form" => $form->createView()
            ));
    }

}
