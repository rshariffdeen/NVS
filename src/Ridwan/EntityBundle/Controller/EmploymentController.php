<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ridwan\EntityBundle\Entity\Employment;
use Ridwan\EntityBundle\Form\EmploymentType;

/**
 * Employment controller.
 *
 * @Route("/employment")
 */
class EmploymentController extends Controller
{

    /**
     * Lists all Employment entities.
     *
     * @Route("/", name="employment")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RidwanEntityBundle:Employment')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Employment entity.
     *
     * @Route("/", name="employment_create")
     * @Method("POST")
     * @Template("RidwanEntityBundle:Employment:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Employment();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('employment_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Employment entity.
     *
     * @param Employment $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Employment $entity)
    {
        $form = $this->createForm(new EmploymentType(), $entity, array(
            'action' => $this->generateUrl('employment_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Employment entity.
     *
     * @Route("/new", name="employment_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Employment();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Employment entity.
     *
     * @Route("/{id}", name="employment_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Employment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Employment entity.
     *
     * @Route("/{id}/edit", name="employment_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Employment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employment entity.');
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
    * Creates a form to edit a Employment entity.
    *
    * @param Employment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Employment $entity)
    {
        $form = $this->createForm(new EmploymentType(), $entity, array(
            'action' => $this->generateUrl('employment_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Employment entity.
     *
     * @Route("/{id}", name="employment_update")
     * @Method("PUT")
     * @Template("RidwanEntityBundle:Employment:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Employment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('employment_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Employment entity.
     *
     * @Route("/{id}", name="employment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RidwanEntityBundle:Employment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Employment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('employment'));
    }

    /**
     * Creates a form to delete a Employment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('employment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
