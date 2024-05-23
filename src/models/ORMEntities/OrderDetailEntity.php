<?php




use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="order_details")
*/
class OrderDetailEntity
{
/**
* @ORM\Id
* @ORM\GeneratedValue(strategy="AUTO")
* @ORM\Column(type="integer")
*/
protected $id;

/**
* @ORM\ManyToOne(targetEntity="OrderEntity", inversedBy="orderDetails")
*/
protected $order;

/**
* @ORM\ManyToOne(targetEntity="ProductEntity")
*/
protected $product;


/**
*  @ORM\Column(type="integer")
*/

protected $count;

/**
* @ORM\ManyToOne(targetEntity="AttributeItem")
*/
protected $selectedAttributeItem_id;





// Getter and setter methods

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }


    public function getSelectedAttribute()
    {
        return $this->selectedAttributeItem_id;
    }

    public function setSelectedAttribute($selectedAttribute_id)
    {
        $this->selectedAttributeItem_id = $selectedAttribute_id;
    }
}