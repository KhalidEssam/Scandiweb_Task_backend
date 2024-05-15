<?php


use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="product_image")
*/
class product_image
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
    private $id;


    /**
    * @ORM\ManyToOne(targetEntity="Product")
    * @ORM\JoinColumn(name="product_id", referencedColumnName="id") 
    */
    private $product_id;


    /**
    * @ORM\Column(type="string")
    */
    private $url;


}