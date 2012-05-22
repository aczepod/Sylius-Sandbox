<?php

/*
 * This file is part of the Sylius sandbox application.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Sandbox\Bundle\AssortmentBundle\Form\Type;

use Sylius\Bundle\AssortmentBundle\Form\Type\CustomizableProductType as BaseCustomizableProductType;
use Sylius\Sandbox\Bundle\AssortmentBundle\Entity\Product;
use Symfony\Component\Form\FormBuilder;

/**
 * Product form type.
 * Extends customizable form type, we just need to add category choice.
 *
 * @author Paweł Jędrzejewkski <pjedrzejewski@diweb.pl>
 */
class ProductType extends BaseCustomizableProductType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('images', 'collection', array(
                'type'         => 'sylius_sandbox_assortment_product_image',
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false
            ))
            ->add('category', 'sylius_categorizer_category_choice', array(
                'multiple' => false,
                'catalog'  => 'assortment'
            ))
            ->add('variantPickingMode', 'choice', array(
                'label'    => 'Variant picking mode',
                'choices'  => Product::getVariantPickingModeChoices()
            ))
        ;
    }
}
