<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ridwan\EntityBundle\Entity\Availability;
use Ridwan\EntityBundle\Form\AvailabilityType;

/**
 * Availability controller.
 *
 * @Route("/availability")
 */
class AvailabilityController extends Controller
{

    /**
     * Lists all Availability entities.
     *
     * @Route("/", name="availability")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RidwanEntityBundle:Availability')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Availability entity.
     *
     * @Route("/", name="availability_create")
     * @Method("POST")
     * @Template("RidwanEntityBundle:Availability:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Availability();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('availability_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Availability entity.
     *
     * @param Availability $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Availability $entity)
    {
        $form = $this->createForm(new AvailabilityType(), $entity, array(
            'action' => $this->generateUrl('availability_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Availability entity.
     *
     * @Route("/new", name="availability_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Availability();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Availability entity.
     *
     * @Route("/{id}", name="availability_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Availability')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Availability entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Availability entity.
     *
     * @Route("/{id}/edit", name="availability_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Availability')->findOneBy(array('user'=>$id));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Availability entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Availability entity.
    *
    * @param Availability $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Availability $entity)
    {
        $form = $this->createForm(new AvailabilityType(), $entity, array(
            'action' => $this->generateUrl('ridwan_availability_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Availability entity.
     *
     * @Route("/{id}", name="availability_update")
     * @Method("PUT")
     * @Template("RidwanEntityBundle:Availability:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        if ($this->getUser()->getId() != $id){
            $this->render('RidwanSiteBundle:Error:permission.html.twig');
        }
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Availability')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Availability entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
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
     * Deletes a Availability entity.
     *
     * @Route("/{id}", name="availability_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RidwanEntityBundle:Availability')->findOneBy(array('user'=>$id));

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Availability entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('availability'));
    }

    /**
     * Creates a form to delete a Availability entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ridwan_availability_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
