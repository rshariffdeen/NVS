<?php

namespace Ridwan\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('cause')
            ->add('location')
            ->add(
                'startdate', 'text', array(
                    'label_attr' => array('class' => 'control-label'),
                    'label' => 'Date',
                    'attr' => array(
                        'placeholder' => 'date',
                        'class' => 'input-large datepicker',
                        'data' => \Date('today'),
                    )
                )
            )
            ->add(
                'proposedenddate', 'text', array(
                    'label_attr' => array('class' => 'control-label'),
                    'label' => 'Date',
                    'attr' => array(
                        'placeholder' => 'date',
                        'class' => 'input-large datepicker',
                        'data' => \Date('today'),
                    )
                )
            )

            ->add(
                'description', 'textarea', array(
                    'attr' => array(
                        'style' => "height:150px; resize:none",
                        'class' => 'span8',
                        'placeholder' => 'write a good description for the project'
                    )
                )
            )

            ->add(
                'submit', 'submit', array(
                    'label' => 'Create Project'
                )
            );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Ridwan\EntityBundle\Entity\Project'
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ridwan_entitybundle_project';
    }

}