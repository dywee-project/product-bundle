<?php

namespace Dywee\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Dywee\CoreBundle\Form\Type\SeoType;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('images',    'collection',  array(
                    'type' => new ProductImageType(),
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false
                )
            )
            ->add('name')
            ->add('brand',      'entity',       array(
                'required' => false,
                'class' => 'DyweeProductBundle:Brand',
                'property' => 'name',))
            ->add('price',          'money',       array('required' => false))
            ->add('isPriceTTC',         'checkbox', array('required' => false, 'label' => 'Prix TTC'))
            ->add('seo',                new SeoType(),      array(
                'data_class' => 'Dywee\BlogBundle\Entity\Article'
            ))
            ->add('shortDescription',   'ckeditor', array('required' => false))
            ->add('mediumDescription',  'ckeditor', array('required' => false))
            ->add('longDescription',    'ckeditor', array('required' => false))
            ->add('sellType',           'choice',   array('choices' => array(1 => 'Vente', 2 => 'Louable', 0 => 'Dematérialisé', 3 => 'Service')))
            ->add('length',             'number',   array('required' => false))
            ->add('width',              'number',   array('required' => false))
            ->add('height',             'number',   array('required' => false))
            ->add('weight',             'number',   array('required' => false))
            ->add('stock',              'number',   array('required' => false))
            ->add('isPromotion',        'checkbox', array('required' => false, 'label' => 'En promotion'))
            ->add('promotionPrice',     'money',   array('required' => false))
            ->add('productType',        'choice',   array('choices' => array(1 => 'Produit', 2 => 'Pack de produit', 3 => 'Abonnement', 4 => 'Service')))
            ->add('state',              'choice',   array('choices' => array(0 => 'Indisponible', 1 => 'Disponible', 2 => 'Bientot disponible', 3 => 'Seulement en magasin', 4 => 'Seulement en pack ou abonnement', 5 => 'Rupture de stock')))
            ->add('categories',         'entity',       array(
                'required' => false,
                'class' => 'DyweeProductBundle:Category',
                'property' => 'indentedName',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'query_builder' => function($er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.root', 'ASC')
                        ->addOrderBy('c.lft', 'ASC');
                }
            ))
            ->add('features', 'collection',   array(
                'type'          => new FeatureElementType(),
                'allow_add'     => true,
                'allow_delete'  => true,
                'by_reference'  => false
            ))
            ->add('packElements', 'collection',   array(
                'type'          => new PackElementType(),
                'allow_add'     => true,
                'allow_delete'  => true,
                'by_reference'  => false
            ))
            ->add('productVariants', 'collection',
            array(
                'type'          => new ProductVariantType(),
                'allow_add'     => true,
                'allow_delete'  => true,
                'by_reference'  => false
            ))
            ->add('sauvegarder',    'submit');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dywee\ProductBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dywee_eshopbundle_product';
    }
}