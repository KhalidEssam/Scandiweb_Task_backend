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


    public function getId()
    {
        return $this->id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;                            
    }

    public function getUrl()        
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }


}