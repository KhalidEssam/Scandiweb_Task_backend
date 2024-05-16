<?php


use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
* @ORM\Table(name="currencies")
*/
class Currency
{
/**
* @ORM\Id
* @ORM\GeneratedValue
* @ORM\Column(type="integer")
*/
private $id;

/**
* @ORM\Column(type="string")
*/
private $label;

/**
* @ORM\Column(type="string", length=3)
*/
private $symbol;

// Getters and setters for id, name, and symbol




public function getId(): ?int
{
    return $this->id;
}

public function getlabel(): ?string
{
    return $this->label;
}

public function setlabel(string $label): void
{
    $this->label = $label;
}

public function getSymbol(): ?string
{
    return $this->symbol;
}

public function setSymbol(string $symbol): void
{
    $this->symbol = $symbol;
}

}