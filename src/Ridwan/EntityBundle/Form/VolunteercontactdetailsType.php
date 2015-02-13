<?php

namespace Ridwan\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VolunteercontactdetailsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mobile')
            ->add('phone')
            ->add('fax')
            ->add('streetnumber')
            ->add('street')
            ->add('city')
            ->add('country')
            ->add('divisionalsecretary', 'entity', array(
                    'label' => 'Select your primary role',
                    'class' => 'RidwanEntityBundle:Locations',
                    'property' => 'Place',
                    'label_attr' => array('class' => 'control-label'),
                    'attr' => array(
                        'class' => 'controls span6',
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
            'data_class' => 'Ridwan\EntityBundle\Entity\Volunteercontactdetails'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ridwan_entitybundle_volunteercontactdetails';
    }
}
