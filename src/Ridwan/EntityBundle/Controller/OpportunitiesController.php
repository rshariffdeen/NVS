<?php

namespace Ridwan\EntityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ridwan\EntityBundle\Entity\Opportunities;
use Ridwan\EntityBundle\Form\OpportunitiesType;

/**
 * Opportunities controller.
 *
 * @Route("/opportunities")
 */
class OpportunitiesController extends Controller
{

    /**
     * Lists all Opportunities entities.
     *
     * @Route("/", name="opportunities")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RidwanEntityBundle:Opportunities')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Opportunities entity.
     *
     * @Route("/", name="opportunities_create")
     * @Method("POST")
     * @Template("RidwanEntityBundle:Opportunities:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Opportunities();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('opportunities_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Opportunities entity.
     *
     * @param Opportunities $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Opportunities $entity)
    {
        $form = $this->createForm(new OpportunitiesType(), $entity, array(
            'action' => $this->generateUrl('opportunities_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Opportunities entity.
     *
     * @Route("/new", name="opportunities_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Opportunities();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Opportunities entity.
     *
     * @Route("/{id}", name="opportunities_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Opportunities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opportunities entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Opportunities entity.
     *
     * @Route("/{id}/edit", name="opportunities_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Opportunities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opportunities entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return  $this->render('RidwanEntityBundle:Opportunities:edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Opportunities entity.
    *
    * @param Opportunities $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Opportunities $entity)
    {
        $form = $this->createForm(new OpportunitiesType(), $entity, array(
            'action' => $this->generateUrl('ridwan_opportunity_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array ('class'  => 'form-horizontal center')
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Opportunities entity.
     *
     * @Route("/{id}", name="opportunities_update")
     * @Method("PUT")
     * @Template("RidwanEntityBundle:Opportunities:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RidwanEntityBundle:Opportunities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opportunities entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $opportunity = $editForm->getData();
            $profession = $opportunity->getRole()->getSelection();
            $location = $opportunity->getLocation()->getPlace();
            $opportunity->setLocation($location);
            $opportunity->setRole($profession);




            $em->flush();

            return $this->redirect($this->generateUrl('ridwan_opportunity_details', array('opportunityID'=>$id,'type' => 'S', 'message' => 'successfully updated your information')));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Opportunities entity.
     *
     * @Route("/{id}", name="opportunities_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RidwanEntityBundle:Opportunities')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Opportunities entity.');
            }
            try{
                $em->remove($entity);
                $em->flush();
            }
            catch(\Exception $e){
                echo $e;
            }
            return $this->redirect($this->generateUrl('ridwan_opportunity_index',array('type' => 'S', 'message' => 'successfully deleted your opportunity')));

        }
        return $this->redirect($this->generateUrl('ridwan_opportunity_details',array('opportunityID'=>$id,'type' => 'E', 'message' => 'could not delete your opportunity')));
    }

    /**
     * Creates a form to delete a Opportunities entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ridwan_opportunity_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
