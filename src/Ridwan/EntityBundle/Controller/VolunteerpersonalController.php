<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ridwan\EntityBundle\Entity\Volunteerpersonal;
use Ridwan\EntityBundle\Form\VolunteerpersonalType;

/**
 * Volunteerpersonal controller.
 *
 * @Route("/volunteerpersonal")
 */
class VolunteerpersonalController extends Controller
{

    /**
     * Lists all Volunteerpersonal entities.
     *
     * @Route("/", name="volunteerpersonal")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Volunteerpersonal entity.
     *
     * @Route("/", name="volunteerpersonal_create")
     * @Method("POST")
     * @Template("RidwanEntityBundle:Volunteerpersonal:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Volunteerpersonal();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('volunteerpersonal_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Volunteerpersonal entity.
     *
     * @param Volunteerpersonal $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Volunteerpersonal $entity)
    {
        $form = $this->createForm(new VolunteerpersonalType(), $entity, array(
            'action' => $this->generateUrl('volunteerpersonal_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Volunteerpersonal entity.
     *
     * @Route("/new", name="volunteerpersonal_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Volunteerpersonal();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Volunteerpersonal entity.
     *
     * @Route("/{id}", name="volunteerpersonal_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Volunteerpersonal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Volunteerpersonal entity.
     *
     * @Route("/{id}/edit", name="volunteerpersonal_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Volunteerpersonal entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RidwanEntityBundle:Volunteerpersonal:edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Volunteerpersonal entity.
    *
    * @param Volunteerpersonal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Volunteerpersonal $entity)
    {
        $form = $this->createForm(new VolunteerpersonalType(), $entity, array(
            'action' => $this->generateUrl('ridwan_volunteerpersonal_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Volunteerpersonal entity.
     *
     * @Route("/{id}", name="volunteerpersonal_update")
     * @Method("PUT")
     * @Template("RidwanEntityBundle:Volunteerpersonal:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Volunteerpersonal entity.');
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
     * Deletes a Volunteerpersonal entity.
     *
     * @Route("/{id}", name="volunteerpersonal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RidwanEntityBundle:Volunteerpersonal')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Volunteerpersonal entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('volunteerpersonal'));
    }

    /**
     * Creates a form to delete a Volunteerpersonal entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ridwan_volunteerpersonal_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
