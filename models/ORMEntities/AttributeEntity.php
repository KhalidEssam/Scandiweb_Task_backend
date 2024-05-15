<?php


use Doctrine\ORM\Mapping as ORM;
class AttributeEntity
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
private $name;

// Getters and setters for id and name

public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}