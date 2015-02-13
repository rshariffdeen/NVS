<?php

namespace Ridwan\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmploymentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('occupation')
            ->add('organizationtype', 'choice', array(
                    'choices' => array(
                        'Government State' => 'Government State',
                        'Non Government Organization' => 'Non Government Organization',
                        'Volunteering Organization' => 'Volunteering Organization',
                        'Private Sector' => 'Private Sector',
                        'Academia' => 'Academia',
                        'Military' => 'Military',
                        'Other' => 'Other'
                    ),
                    'attr' => array(
                        'class' => 'controls',
                        'data-rel' => 'chosen'
                    )
                ))
            ->add('organization')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ridwan\EntityBundle\Entity\Employment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ridwan_entitybundle_employment';
    }
}
