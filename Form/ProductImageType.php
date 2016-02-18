<?php

namespace Dywee\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductImageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('src', 'genemu_jqueryfile', array(
                'multiple' => true
            ))*/
            ->add('src', 'elfinder',    array('instance'=>'form', 'enable'=>true))
            ->add('alt', 'text',        array('required' => false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dywee\ProductBundle\Entity\ProductImage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dywee_productbundle_image';
    }
}