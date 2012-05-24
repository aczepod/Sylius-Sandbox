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

use Sylius\Bundle\AssortmentBundle\Model\ProductInterface;

/**
 * Image entity.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Image
{
    /**
     * Image id.
     *
     * @var int
     */
    protected $id;

    /**
     * Product.
     *
     * @var Product
     */
    protected $product;

    /**
     * Image path.
     *
     * @var string
     */
    protected $path;

    public $image;

    /**
     * Product.
     *
     * @var ProductInterface
     */
    protected $product;

    public function getId()
    {
        return $this->id;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
    }

    public function getAbsolutePath()
    {
        return null === $this->getPath() ? null : $this->getUploadRootDir() . DIRECTORY_SEPARATOR . $this->getPath();
    }

    public function getWebPath()
    {
        return null === $this->getPath() ? null : $this->getUploadDir() . DIRECTORY_SEPARATOR . $this->getPath();
    }

    public function getUploadDir()
    {
        return 'uploads/images';
    }

    public function save()
    {
        if (null === $this->image) {

            return;
        }

        $this->setPath(uniqid() . '.' . $this->image->guessExtension());
        $this->image->move($this->getUploadRootDir(), $this->getPath());
    }

    public function delete()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../../../public/' . $this->getUploadDir();
    }
}
