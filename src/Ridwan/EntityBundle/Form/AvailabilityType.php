<?php

namespace Ridwan\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AvailabilityType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('days', 'choice', array(
                    'expanded' => true,
                    'multiple' => true,
                    'choices'  => array(
                        'Sunday' => 'Sunday',
                        'Monday'  => 'Monday',
                        'Tuesday'   => 'Tuesday',
                        'Wednesday'   => 'Wednesday',
                        'Thursday'   => 'Thursday',
                        'Friday'    => 'Friday',
                        'Saturday'  => 'Saturday'
                    ),
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

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ridwan\EntityBundle\Entity\Availability'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ridwan_entitybundle_availability';
    }
}
