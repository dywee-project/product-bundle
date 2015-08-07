<?php

namespace Dywee\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductOption
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ProductOption
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Dywee\ProductBundle\Entity\ProductOptionValue", mappedBy="productOption", cascade={"persist", "remove"})
     */
    private $productOptionValues;


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
     * Set name
     *
     * @param string $name
     *
     * @return ProductOption
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productOptionValues = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add productOptionValue
     *
     * @param \Dywee\ProductBundle\Entity\ProductOptionValue $productOptionValue
     *
     * @return ProductOption
     */
    public function addProductOptionValue(\Dywee\ProductBundle\Entity\ProductOptionValue $productOptionValue)
    {
        $this->productOptionValues[] = $productOptionValue;
        $productOptionValue->setProductOption($this);

        return $this;
    }

    /**
     * Remove productOptionValue
     *
     * @param \Dywee\ProductBundle\Entity\ProductOptionValue $productOptionValue
     */
    public function removeProductOptionValue(\Dywee\ProductBundle\Entity\ProductOptionValue $productOptionValue)
    {
        $this->productOptionValues->removeElement($productOptionValue);
    }

    /**
     * Get productOptionValues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductOptionValues()
    {
        return $this->productOptionValues;
    }
}
