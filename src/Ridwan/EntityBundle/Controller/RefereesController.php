<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ridwan\EntityBundle\Entity\Referees;
use Ridwan\EntityBundle\Form\RefereesType;

/**
 * Referees controller.
 *
 * @Route("/referees")
 */
class RefereesController extends Controller
{

    /**
     * Lists all Referees entities.
     *
     * @Route("/", name="referees")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RidwanEntityBundle:Referees')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Referees entity.
     *
     * @Route("/", name="referees_create")
     * @Method("POST")
     * @Template("RidwanEntityBundle:Referees:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Referees();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('referees_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Referees entity.
     *
     * @param Referees $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Referees $entity)
    {
        $form = $this->createForm(new RefereesType(), $entity, array(
            'action' => $this->generateUrl('referees_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Referees entity.
     *
     * @Route("/new", name="referees_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Referees();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Referees entity.
     *
     * @Route("/{id}", name="referees_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Referees')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referees entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Referees entity.
     *
     * @Route("/{id}/edit", name="referees_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Referees')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referees entity.');
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
    * Creates a form to edit a Referees entity.
    *
    * @param Referees $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Referees $entity)
    {
        $form = $this->createForm(new RefereesType(), $entity, array(
            'action' => $this->generateUrl('referees_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Referees entity.
     *
     * @Route("/{id}", name="referees_update")
     * @Method("PUT")
     * @Template("RidwanEntityBundle:Referees:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Referees')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Referees entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('referees_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Referees entity.
     *
     * @Route("/{id}", name="referees_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RidwanEntityBundle:Referees')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Referees entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('referees'));
    }

    /**
     * Creates a form to delete a Referees entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('referees_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
