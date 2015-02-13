<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ridwan\EntityBundle\Entity\Physicalresourcesmapping;
use Ridwan\EntityBundle\Form\PhysicalresourcesmappingType;

/**
 * Physicalresourcesmapping controller.
 *
 * @Route("/physicalresourcesmapping")
 */
class PhysicalresourcesmappingController extends Controller
{

    /**
     * Lists all Physicalresourcesmapping entities.
     *
     * @Route("/", name="physicalresourcesmapping")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RidwanEntityBundle:Physicalresourcesmapping')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Physicalresourcesmapping entity.
     *
     * @Route("/", name="physicalresourcesmapping_create")
     * @Method("POST")
     * @Template("RidwanEntityBundle:Physicalresourcesmapping:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Physicalresourcesmapping();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('physicalresourcesmapping_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Physicalresourcesmapping entity.
     *
     * @param Physicalresourcesmapping $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Physicalresourcesmapping $entity)
    {
        $form = $this->createForm(new PhysicalresourcesmappingType(), $entity, array(
            'action' => $this->generateUrl('physicalresourcesmapping_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Physicalresourcesmapping entity.
     *
     * @Route("/new", name="physicalresourcesmapping_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Physicalresourcesmapping();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Physicalresourcesmapping entity.
     *
     * @Route("/{id}", name="physicalresourcesmapping_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Physicalresourcesmapping')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Physicalresourcesmapping entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Physicalresourcesmapping entity.
     *
     * @Route("/{id}/edit", name="physicalresourcesmapping_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Physicalresourcesmapping')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Physicalresourcesmapping entity.');
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
    * Creates a form to edit a Physicalresourcesmapping entity.
    *
    * @param Physicalresourcesmapping $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Physicalresourcesmapping $entity)
    {
        $form = $this->createForm(new PhysicalresourcesmappingType(), $entity, array(
            'action' => $this->generateUrl('physicalresourcesmapping_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Physicalresourcesmapping entity.
     *
     * @Route("/{id}", name="physicalresourcesmapping_update")
     * @Method("PUT")
     * @Template("RidwanEntityBundle:Physicalresourcesmapping:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Physicalresourcesmapping')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Physicalresourcesmapping entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('physicalresourcesmapping_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Physicalresourcesmapping entity.
     *
     * @Route("/{id}", name="physicalresourcesmapping_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RidwanEntityBundle:Physicalresourcesmapping')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Physicalresourcesmapping entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('physicalresourcesmapping'));
    }

    /**
     * Creates a form to delete a Physicalresourcesmapping entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('physicalresourcesmapping_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
