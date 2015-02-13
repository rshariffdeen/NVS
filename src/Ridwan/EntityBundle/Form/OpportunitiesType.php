<?php

namespace Ridwan\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OpportunitiesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('cause', 'choice', array(
                    'choices'  => array(
                        'Agriculture' => 'Agriculture',
                        'Business Development'  => 'Business Development',
                        'Communications'   => 'Communications',
                        'Education'   => 'Education',
                        'Engineering'   => 'Engineering',
                        'Finance'   => 'Finance',
                        'Health'   => 'Health',
                        'Human Resource'   => 'Human Resource',
                        'Information Technology'   => 'Information Technology',
                        'Legal'   => 'Legal',
                        'Management'   => 'Management',
                        'Military Specific'   => 'Military Specific',
                        'Natural Resource Management'   => 'Natural Resource Management',
                        'Office & Administrative Support'   => 'Office & Administrative Support',
                        'Plant and Machine Operators'   => 'Plant and Machine Operators',
                        'Surveyor\'s Services'   => 'Surveyor\'s Services',
                        'Special Education'   => 'Special Education',
                        'Social Worker'   => 'Social Worker',
                        'Social Development '   => 'Social Development ',
                        'Support Services'   => 'Support Services',
                        'Technical'   => 'Technical',
                        'Translator\'s Service'   => 'Translator\'s Service',
                        'Vocational Technical Trainer'   => 'Vocational Technical Trainer'
                    ),
                    'attr' => array(
                        'class' => 'controls',
                        'data-rel' => 'chosen'
                    )
                ))
            ->add('location', 'entity', array(
                    'label' => 'Select your primary role',
                    'class' => 'RidwanEntityBundle:Locations',
                    'property' => 'Place',
                    'label_attr' => array('class' => 'control-label'),
                    'attr' => array(
                        'class' => 'controls span6',
                        'data-rel' => 'chosen'
                    )

                ))
            ->add('description', 'textarea', array(
                    'attr' => array(
                        'style' => "height:150px; resize:none",
                        'class' => 'span8',
                        'placeholder' => 'write a good description for the task')))
            ->add('shortdescription', 'textarea', array(
                    'attr' => array(
                        'style' => "height:70px; resize:none",
                        'class' => 'span8',
                        'placeholder' => 'write a short description for the volunteer')))
            ->add('startdate', 'text', array(
                    'label_attr' => array('class' => 'control-label'),
                    'label' => 'Date',
                    'attr' => array(
                        'placeholder' => 'date',
                        'class' => 'input-large datepicker',
                        'data' => \Date('today'),
                    )
                ))

            ->add('enddate', 'text', array(
                    'label_attr' => array('class' => 'control-label'),
                    'label' => 'Date',
                    'attr' => array(
                        'placeholder' => 'date',
                        'class' => 'input-large datepicker',
                        'data' => \Date('today'),
                    )
                ))

            ->add('numberofvolunteers')
            ->add('agegroup', 'choice', array(
                    'choices' => array(
                        'Any' => 'Any',
                        '15-20' => '15-20',
                        '20-25' => '20-25',
                        '25-30' => '25-30',
                        '30-35' => '30-35',
                        '35-40' => '35-40',
                        '40-45' => '40-45',
                        '45-50' => '45-50'
                    ),
                    'attr' => array(
                        'class' => 'controls',
                        'data-rel' => 'chosen'
                    )
                ))

            ->add('training', 'textarea', array(
                    'attr' => array(
                        'style' => "height:70px; resize:none",
                        'class' => 'span8',
                        'placeholder' => 'what kind of training will you be providing')))

            ->add('expenses', 'textarea', array(
                    'attr' => array(
                        'style' => "height:70px; resize:none",
                        'class' => 'span8',
                        'placeholder' => 'what are the expenses you will cover for the volunteer')))
            ->add('difficulty', 'choice', array(
                    'choices' => array(
                        '2' => 'Very Easy',
                        '4' => 'Easy',
                        '6' => 'Normal',
                        '8' => 'Difficult',
                        '10' => 'Hard'
                    ),
                    'attr' => array(
                        'class' => 'controls',
                        'data-rel' => 'chosen'
                    )
                ))
            ->add('role', 'entity', array(
                    'label' => 'Select your primary role',
                    'class' => 'RidwanEntityBundle:Profession',
                    'property' => 'selection',
                    'label_attr' => array('class' => 'control-label'),
                    'attr' => array(
                        'class' => 'controls span6',
                        'data-rel' => 'chosen'
                    )

                ))

            ->add('time', 'choice', array(
                    'expanded' => true,
                    'multiple' => true,
                    'choices'  => array(
                        '07:00 - 08:00'  => '07:00 - 08:00',
                        '08:00 - 09:00' => '08:00 - 09:00',
                        '09:00 - 10:00'  => '09:00 - 10:00',
                        '10:00 - 11:00' => '10:00 - 11:00',
                        '11:00 - 12:00'  => '11:00 - 12:00',
                        '12:00 - 13:00' => '12:00 - 13:00',
                        '13:00 - 14:00'  => '13:00 - 14:00',
                        '14:00 - 15:00' => '14:00 - 15:00',
                        '15:00 - 16:00'  => '15:00 - 16:00',
                        '16:00 - 17:00' => '16:00 - 17:00',
                        '17:00 - 18:00'  => '17:00 - 18:00',
                        '18:00 - 19:00' => '18:00 - 19:00',
                        '19:00 - 20:00'  => '19:00 - 20:00',
                        '20:00 - 21:00' => '20:00 - 21:00',

                    ),
                ))

            ->add('submit','submit')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ridwan\EntityBundle\Entity\Opportunities'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ridwan_entitybundle_opportunities';
    }
}
