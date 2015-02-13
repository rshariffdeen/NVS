<?php

namespace Moraspirit\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccountType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder       
                ->add('currentpassword','password')
                ->add('newpassword','password')
                ->add('confirmpassword','password')
                ->add('submit', 'submit', array(
                    'label' => 'Change Password'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Moraspirit\EntityBundle\Entity\Account'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'moraspirit_account';
    }

}
