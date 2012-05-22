<?php

/*
 * This file is part of the Sylius sandbox application.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Sandbox\Bundle\AssortmentBundle\Entity;

use Sylius\Bundle\CategorizerBundle\Model\CategoryInterface;
use Sylius\Bundle\AssortmentBundle\Entity\CustomizableProduct as BaseProduct;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class Product extends BaseProduct
{
    const VARIANT_PICKING_CHOICE = 0;
    const VARIANT_PICKING_MATCH  = 1;

    /**
     * Product category.
     *
     * @Assert\NotBlank
     *
     * @var CategoryInterface
     */
    protected $category;

    /**
     * Variant picking mode.
     * Whether to display a choice form with all variants or match variant for
     * given options.
     *
     * @var integer
     */
    protected $variantPickingMode;

    /**
     * Product images.
     *
     * @var ArrayCollection
     */
    protected $images;

    /**
     * Set default variant picking mode.
     */
    public function __construct()
    {
        parent::__construct();

        $this->variantPickingMode = self::VARIANT_PICKING_CHOICE;
        $this->images = new ArrayCollection();
    }

    /**
     * Get category.
     *
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category.
     *
     * @param CategoryInterface $category
     */
    public function setCategory(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function getVariantPickingMode()
    {
        return $this->variantPickingMode;
    }

    public function setVariantPickingMode($variantPickingMode)
    {
        if (!in_array($variantPickingMode, array(self::VARIANT_PICKING_CHOICE, self::VARIANT_PICKING_MATCH))) {
            throw new \InvalidArgumentException('Wrong variant picking mode supplied');
        }

        $this->variantPickingMode = $variantPickingMode;
    }

    public function isVariantPickingModeChoice()
    {
        return self::VARIANT_PICKING_CHOICE === $this->variantPickingMode;
    }

    public function addImage(Image $image)
    {
        $this->images->add($image);
    }

    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
    }

    public function getImages()
    {
        return $this->images;
    }

    /**
     * This is a proxy method to access master variant price.
     * Because if there are no options/variants defined, the master variant is
     * the project.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->masterVariant->getPrice();
    }

    static public function getVariantPickingModeChoices()
    {
        return array(
            self::VARIANT_PICKING_CHOICE => 'Display list of variants',
            self::VARIANT_PICKING_MATCH  => 'Display options'
        );
    }
}
