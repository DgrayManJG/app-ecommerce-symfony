<?php

namespace FarmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart_product
 *
 * @ORM\Table(name="cart_product")
 * @ORM\Entity(repositoryClass="FarmBundle\Repository\Cart_productRepository")
 */
class Cart_product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \FarmBundle\Entity\Cart
     *
     * @ORM\ManyToOne(targetEntity="\FarmBundle\Entity\Cart")
     */
    private $cart;

    /**
     * @var \FarmBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="\FarmBundle\Entity\Product")
     */
    private $product;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set cart
     *
     * @param \FarmBundle\Entity\Cart $cart
     * @return Cart_product
     */
    public function setCart(\FarmBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return \FarmBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set product
     *
     * @param \FarmBundle\Entity\Product $product
     * @return Cart_product
     */
    public function setProduct(\FarmBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \FarmBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
