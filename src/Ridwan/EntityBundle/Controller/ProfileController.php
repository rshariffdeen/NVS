<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ridwan\EntityBundle\Entity\Profile;
use Ridwan\EntityBundle\Form\ProfileType;

/**
 * Profile controller.
 *
 * @Route("/profile")
 */
class ProfileController extends Controller
{

    /**
     * Lists all Profile entities.
     *
     * @Route("/", name="profile")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RidwanEntityBundle:Profile')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Profile entity.
     *
     * @Route("/", name="profile_create")
     * @Method("POST")
     * @Template("RidwanEntityBundle:Profile:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Profile();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('profile_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Profile entity.
     *
     * @param Profile $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Profile $entity)
    {
        $form = $this->createForm(new ProfileType(), $entity, array(
            'action' => $this->generateUrl('profile_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Profile entity.
     *
     * @Route("/new", name="profile_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Profile();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Profile entity.
     *
     * @Route("/{id}", name="profile_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Profile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profile entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Profile entity.
     *
     * @Route("/{id}/edit", name="profile_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Profile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profile entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RidwanEntityBundle:Profile:edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
           'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
    * Creates a form to edit a Profile entity.
    *
    * @param Profile $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Profile $entity)
    {
        $form = $this->createForm(new ProfileType(), $entity, array(
            'action' => $this->generateUrl('ridwan_profile_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array ('class'  => 'form-horizontal center')
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Profile entity.
     *
     * @Route("/{id}", name="profile_update")
     * @Method("PUT")
     * @Template("RidwanEntityBundle:Profile:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Profile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profile entity.');
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
     * Deletes a Profile entity.
     *
     * @Route("/{id}", name="profile_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RidwanEntityBundle:Profile')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Profile entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('profile'));
    }

    /**
     * Creates a form to delete a Profile entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ridwan_profile_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
