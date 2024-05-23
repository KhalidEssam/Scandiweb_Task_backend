<?php


use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="attribute_item")
*/
class AttributeItem
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
* @ORM\Column(type="string")
*/
private $displayValue;

/**
* @ORM\Column(type="string")
*/
private $value;


// Getters and setters for id, attribute, and value

    public function getId()
    {
        return $this->id;   
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAttributeId()
    {        
        return $this->attribute_id;
    }

    public function setAttributeId($attribute_id)
    {
        $this->attribute_id = $attribute_id;
    }

    public function getDisplayValue()
    {
        return $this->displayValue;
    }

    public function setDisplayValue($displayValue)
    {
        $this->displayValue = $displayValue;
    }

    public function getValue()
    {
        return $this->value;
    }   

    public function setValue($value)
    {
        $this->value = $value;
    }

}