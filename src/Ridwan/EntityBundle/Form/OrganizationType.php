<?php

namespace Ridwan\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrganizationType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('branch')
            ->add('type', 'choice', array(
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
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ridwan\EntityBundle\Entity\Organization'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ridwan_entitybundle_organization';
    }
}
