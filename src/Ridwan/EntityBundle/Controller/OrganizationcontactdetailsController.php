<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ridwan\EntityBundle\Entity\Organizationcontactdetails;
use Ridwan\EntityBundle\Form\OrganizationcontactdetailsType;

/**
 * Organizationcontactdetails controller.
 *
 * @Route("/organizationcontactdetails")
 */
class OrganizationcontactdetailsController extends Controller
{

    /**
     * Lists all Organizationcontactdetails entities.
     *
     * @Route("/", name="organizationcontactdetails")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RidwanEntityBundle:Organizationcontactdetails')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Organizationcontactdetails entity.
     *
     * @Route("/", name="organizationcontactdetails_create")
     * @Method("POST")
     * @Template("RidwanEntityBundle:Organizationcontactdetails:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Organizationcontactdetails();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organizationcontactdetails_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Organizationcontactdetails entity.
     *
     * @param Organizationcontactdetails $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Organizationcontactdetails $entity)
    {
        $form = $this->createForm(new OrganizationcontactdetailsType(), $entity, array(
            'action' => $this->generateUrl('organizationcontactdetails_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Organizationcontactdetails entity.
     *
     * @Route("/new", name="organizationcontactdetails_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Organizationcontactdetails();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Organizationcontactdetails entity.
     *
     * @Route("/{id}", name="organizationcontactdetails_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Organizationcontactdetails')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organizationcontactdetails entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Organizationcontactdetails entity.
     *
     * @Route("/{id}/edit", name="organizationcontactdetails_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Organizationcontactdetails')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organizationcontactdetails entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return  $this->render('RidwanEntityBundle:Organizationcontactdetails:edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            ));
    }

    /**
    * Creates a form to edit a Organizationcontactdetails entity.
    *
    * @param Organizationcontactdetails $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Organizationcontactdetails $entity)
    {
        $form = $this->createForm(new OrganizationcontactdetailsType(), $entity, array(
            'action' => $this->generateUrl('ridwan_organizationcontact_update', array('id' => $entity->getId())),
            'method' => 'PUT',
                'attr' => array ('class' => 'form-horizontal center')
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Organizationcontactdetails entity.
     *
     * @Route("/{id}", name="organizationcontactdetails_update")
     * @Method("PUT")
     * @Template("RidwanEntityBundle:Organizationcontactdetails:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Organizationcontactdetails')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organizationcontactdetails entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $contacts = $editForm->getData();
            $location = $contacts->getDivisionalsecretary();
            $contacts->setDivisionalsecretary($location->getDivision());
            $contacts->setDistrict($location->getDistrict());
            $contacts->setProvince($location->getProvince());
            $em->flush();

            return $this->redirect($this->generateUrl('ridwan_site_home', array('type' => 'S', 'message' => 'successfully updated your information')));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Organizationcontactdetails entity.
     *
     * @Route("/{id}", name="organizationcontactdetails_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RidwanEntityBundle:Organizationcontactdetails')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Organizationcontactdetails entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('organizationcontactdetails'));
    }

    /**
     * Creates a form to delete a Organizationcontactdetails entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ridwan_organizationcontact_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
