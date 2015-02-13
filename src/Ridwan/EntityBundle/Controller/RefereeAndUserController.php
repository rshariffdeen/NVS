<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ridwan\EntityBundle\Entity\RefereeAndUser;
use Ridwan\EntityBundle\Form\RefereeAndUserType;

/**
 * RefereeAndUser controller.
 *
 * @Route("/refereeanduser")
 */
class RefereeAndUserController extends Controller
{

    /**
     * Lists all RefereeAndUser entities.
     *
     * @Route("/", name="refereeanduser")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RidwanEntityBundle:RefereeAndUser')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new RefereeAndUser entity.
     *
     * @Route("/", name="refereeanduser_create")
     * @Method("POST")
     * @Template("RidwanEntityBundle:RefereeAndUser:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new RefereeAndUser();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('refereeanduser_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a RefereeAndUser entity.
     *
     * @param RefereeAndUser $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(RefereeAndUser $entity)
    {
        $form = $this->createForm(new RefereeAndUserType(), $entity, array(
            'action' => $this->generateUrl('refereeanduser_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new RefereeAndUser entity.
     *
     * @Route("/new", name="refereeanduser_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new RefereeAndUser();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a RefereeAndUser entity.
     *
     * @Route("/{id}", name="refereeanduser_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:RefereeAndUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RefereeAndUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing RefereeAndUser entity.
     *
     * @Route("/{id}/edit", name="refereeanduser_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:RefereeAndUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RefereeAndUser entity.');
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
    * Creates a form to edit a RefereeAndUser entity.
    *
    * @param RefereeAndUser $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(RefereeAndUser $entity)
    {
        $form = $this->createForm(new RefereeAndUserType(), $entity, array(
            'action' => $this->generateUrl('refereeanduser_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing RefereeAndUser entity.
     *
     * @Route("/{id}", name="refereeanduser_update")
     * @Method("PUT")
     * @Template("RidwanEntityBundle:RefereeAndUser:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:RefereeAndUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RefereeAndUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('refereeanduser_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a RefereeAndUser entity.
     *
     * @Route("/{id}", name="refereeanduser_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RidwanEntityBundle:RefereeAndUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RefereeAndUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('refereeanduser'));
    }

    /**
     * Creates a form to delete a RefereeAndUser entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refereeanduser_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
