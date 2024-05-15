<?php


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="prices")
 */
class PriceEntity
{
/**
* @ORM\Id
* @ORM\GeneratedValue
* @ORM\Column(type="integer")
*/
private $id;

/**
* @ORM\Column(type="float")
*/
private $amount;

/**
* @ORM\ManyToOne(targetEntity="Currency")
* @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
*/
private $currency_id;

// Getters and setters for id, amount, and currency

public function getAmount(): ?float
{
    return $this->amount; 
}

public function get_Currency_id(): ? Currency
{
return $this->currency_id ? $this->currency_id->getId() : null;
}


}