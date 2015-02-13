<?php

namespace Ridwan\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('intro', 'textarea', array(
                    'attr' => array(
                        'style' => "height:150px; resize:none",
                        'class' => 'span8',
                        'placeholder' => 'write a good description about your self')))
            ->add('reason', 'textarea', array(
                    'attr' => array(
                        'style' => "height:150px; resize:none",
                        'class' => 'span8',
                        'placeholder' => 'write a short explanation why you want to volunteer?')))

            ->add('experience', 'textarea', array(
                    'attr' => array(
                        'style' => "height:150px; resize:none",
                        'class' => 'span8',
                        'placeholder' => 'what are your previous experience in Volunteering?')))

            ->add('health', 'textarea', array(
                    'attr' => array(
                        'style' => "height:70px; resize:none",
                        'class' => 'span8',
                        'placeholder' => 'write a description about your health conidition')))

            ->add('drivinglicense', 'choice', array(
                    'choices' => array(
                        'yes' => 'I have a valid License',
                        'no' => 'I don\'t Have',

                    ),
                    'attr' => array(
                        'class' => 'controls',
                        'data-rel' => 'chosen'
                    )
                ))
            ->add('arrested', 'choice', array(
                    'choices' => array(
                        'yes' => 'Yes',
                        'no' => 'No',

                    ),
                    'attr' => array(
                        'class' => 'controls',
                        'data-rel' => 'chosen'
                    )
                ))



        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ridwan\EntityBundle\Entity\Profile'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ridwan_entitybundle_profile';
    }
}
