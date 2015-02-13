<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ridwan\EntityBundle\Entity\Organization;
use Ridwan\EntityBundle\Form\OrganizationType;

/**
 * Organization controller.
 *
 * @Route("/organization")
 */
class OrganizationController extends Controller
{

    /**
     * Lists all Organization entities.
     *
     * @Route("/", name="organization")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RidwanEntityBundle:Organization')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Organization entity.
     *
     * @Route("/", name="organization_create")
     * @Method("POST")
     * @Template("RidwanEntityBundle:Organization:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Organization();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('organization_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Organization entity.
     *
     * @param Organization $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Organization $entity)
    {
        $form = $this->createForm(new OrganizationType(), $entity, array(
            'action' => $this->generateUrl('organization_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Organization entity.
     *
     * @Route("/new", name="organization_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Organization();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Organization entity.
     *
     * @Route("/{id}", name="organization_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Organization')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Organization entity.
     *
     * @Route("/{id}/edit", name="organization_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Organization')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RidwanEntityBundle:Organization:edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Organization entity.
    *
    * @param Organization $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Organization $entity)
    {
        $form = $this->createForm(new OrganizationType(), $entity, array(
            'action' => $this->generateUrl('ridwan_organization_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array ('class'  => 'form-horizontal center')
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Organization entity.
     *
     * @Route("/{id}", name="organization_update")
     * @Method("PUT")
     * @Template("RidwanEntityBundle:Organization:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Organization')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organization entity.');
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
     * Deletes a Organization entity.
     *
     * @Route("/{id}", name="organization_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RidwanEntityBundle:Organization')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Organization entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('organization'));
    }

    /**
     * Creates a form to delete a Organization entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ridwan_organization_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
