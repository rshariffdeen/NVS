<?php

namespace Ridwan\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EducationType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('institution')
            ->add('degree', 'choice', array(
                    'choices' => array(
                        'Advance Level' => 'Advance Level',
                        'Diploma' => 'Diploma',
                        'Certificate' => 'Certificate',
                        'NDT' => 'NDT',
                        'Associate of Arts (A.A.)' =>'Associate of Arts (A.A.)',
                        'Associate of Science (A.S.)'=>'Associate of Science (A.S.)',
                        'Associate of Applied Science (AAS)' => 'Associate of Applied Science (AAS)',
                        'Bachelor of Arts (B.A.)' => 'Bachelor of Arts (B.A.)',
                        'Bachelor of Science (B.S.)' => 'Bachelor of Science (B.S.)',
                        'Bachelor of Fine Arts (BFA)' => 'Bachelor of Fine Arts (BFA)',
                        'Master of Arts (M.A.)' => 'Master of Arts (M.A.)',
                        'Master of Science (M.S.)' => 'Master of Science (M.S.)',
                        'Master of Business Administration (MBA)' => 'Master of Business Administration (MBA)',
                        'Master of Fine Arts (MFA)' => 'Master of Fine Arts (MFA)',
                        'Doctor of Philosophy (Ph.D.)' => 'Doctor of Philosophy (Ph.D.)',
                        'Juris Doctor (J.D.)' => 'Juris Doctor (J.D.)',
                        'Doctor of Medicine (M.D.)' => 'Doctor of Medicine (M.D.)',
                        'Doctor of Dental Surgery (DDS)' => 'Doctor of Dental Surgery (DDS)'
                    )
                ))
            ->add('field')
            ->add('duration')

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ridwan\EntityBundle\Entity\Education'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ridwan_entitybundle_education';
    }
}
