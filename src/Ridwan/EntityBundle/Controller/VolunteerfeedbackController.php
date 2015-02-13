<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ridwan\EntityBundle\Entity\Volunteerfeedback;
use Ridwan\EntityBundle\Form\VolunteerfeedbackType;

/**
 * Volunteerfeedback controller.
 *
 * @Route("/volunteerfeedback")
 */
class VolunteerfeedbackController extends Controller
{

    /**
     * Lists all Volunteerfeedback entities.
     *
     * @Route("/", name="volunteerfeedback")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RidwanEntityBundle:Volunteerfeedback')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Volunteerfeedback entity.
     *
     * @Route("/", name="volunteerfeedback_create")
     * @Method("POST")
     * @Template("RidwanEntityBundle:Volunteerfeedback:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Volunteerfeedback();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('volunteerfeedback_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Volunteerfeedback entity.
     *
     * @param Volunteerfeedback $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Volunteerfeedback $entity)
    {
        $form = $this->createForm(new VolunteerfeedbackType(), $entity, array(
            'action' => $this->generateUrl('volunteerfeedback_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Volunteerfeedback entity.
     *
     * @Route("/new", name="volunteerfeedback_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Volunteerfeedback();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Volunteerfeedback entity.
     *
     * @Route("/{id}", name="volunteerfeedback_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Volunteerfeedback')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Volunteerfeedback entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Volunteerfeedback entity.
     *
     * @Route("/{id}/edit", name="volunteerfeedback_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Volunteerfeedback')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Volunteerfeedback entity.');
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
    * Creates a form to edit a Volunteerfeedback entity.
    *
    * @param Volunteerfeedback $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Volunteerfeedback $entity)
    {
        $form = $this->createForm(new VolunteerfeedbackType(), $entity, array(
            'action' => $this->generateUrl('volunteerfeedback_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Volunteerfeedback entity.
     *
     * @Route("/{id}", name="volunteerfeedback_update")
     * @Method("PUT")
     * @Template("RidwanEntityBundle:Volunteerfeedback:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Volunteerfeedback')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Volunteerfeedback entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('volunteerfeedback_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Volunteerfeedback entity.
     *
     * @Route("/{id}", name="volunteerfeedback_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RidwanEntityBundle:Volunteerfeedback')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Volunteerfeedback entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('volunteerfeedback'));
    }

    /**
     * Creates a form to delete a Volunteerfeedback entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('volunteerfeedback_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
