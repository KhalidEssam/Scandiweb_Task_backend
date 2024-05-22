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
}