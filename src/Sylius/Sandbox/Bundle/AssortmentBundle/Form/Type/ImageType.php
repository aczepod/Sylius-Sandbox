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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Image form type.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class ImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('image', 'file')
            ->add('updatedAt')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Sylius\\Sandbox\\Bundle\\AssortmentBundle\\Entity\\Image'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_sandbox_assortment_product_image';
    }
}
