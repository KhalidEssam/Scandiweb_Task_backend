<?php


use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="product_attribute")
*/
class Product_Attribute
{

    /**
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
    private $id;


    /**
    * @ORM\ManyToOne(targetEntity="AttributeEntity")
    * @ORM\JoinColumn(name="attribute_id", referencedColumnName="id")
    */
    private $attribute_id;


    /**
    * @ORM\ManyToOne(targetEntity="Product")
    * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
    */
    private $product_id;

    /**
     * @ORM\ManyToOne(targetEntity="AttributeItem")
     * @ORM\JoinColumn(name="attribute_item_id", referencedColumnName="id")
     */
    private $attribute_item_id;


    // Getters and setters for id, attribute, and value

}