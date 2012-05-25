<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Sandbox\Bundle\AssortmentBundle\Manipulator;

use Sylius\Bundle\AssortmentBundle\Manipulator\ProductManipulator as BaseProductManipulator;
use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;

/**
 * Product manipulator. Will trigger image upload on persist/update.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class ProductManipulator extends BaseProductManipulator
{
    /**
     * {@inheritdoc}
     */
    public function create(ProductInterface $product)
    {
        $this->triggerImageUpload($product);
        parent::create($product);
    }

    /**
     * {@inheritdoc}
     */
    public function update(ProductInterface $product)
    {
        $this->triggerImageUpload($product);
        parent::update($product);
    }

    protected function triggerImageUpload(ProductInterface $product)
    {
        foreach ($product->getImages() as $image) {
            $image->upload();
        }
    }
}
