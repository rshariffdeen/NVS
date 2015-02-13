<?php

namespace Ridwan\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SkillsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('causes', 'choice', array(
                    'expanded' => true,
                    'multiple' => true,
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
                ))
            ->add('primary', 'entity', array(
                    'label' => 'Select your primary role',
                    'class' => 'RidwanEntityBundle:Profession',
                    'property' => 'selection',
                    'label_attr' => array('class' => 'control-label'),
                    'attr' => array(
                        'class' => 'controls span6',
                        'data-rel' => 'chosen'
                    )

                ))

            ->add('secondary', 'entity', array(
                    'label' => 'Select your primary role',
                    'class' => 'RidwanEntityBundle:Profession',
                    'property' => 'selection',
                    'label_attr' => array('class' => 'control-label'),
                    'attr' => array(
                        'class' => 'controls span6',
                        'data-rel' => 'chosen'
                    )

                ))


            ->add('languages', 'choice', array(
                    'expanded' => true,
                    'multiple' => true,
                    'choices'  => array(
                        'English' => 'English',
                        'Sinhala'  => 'Sinhala',
                        'Tamil'   => 'Tamil',
                        'Hindi'   => 'Hindi',
                        'Spanish'   => 'Spanish',
                        'Arabic'   => 'Arabic',
                        'Chinese'   => 'Chinese',
                        'French'   => 'French'
                    ),
                ))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ridwan\EntityBundle\Entity\Skills'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ridwan_entitybundle_skills';
    }
}
