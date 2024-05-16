<?php


use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */

class Product {
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inStock;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity="CategoryEntity")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category_id;

    /**
     * @ORM\ManyToOne(targetEntity="PriceEntity")
     * @ORM\JoinColumn(name="price_id", referencedColumnName="id")
     */
    private $price;


    // Getters and setters
    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getInStock(): ?bool
    {
        return $this->inStock;
    }

    public function setInStock(bool $inStock): void
    {
        $this->inStock = $inStock;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }

    public function getCategory(): ?int
    {
        return $this->category_id ? $this->category_id->getId() : null;
    }

    public function setCategory(?CategoryEntity $category): void
    {
        $this->category_id = $category;
    }

    public function getPrice(): ?PriceEntity
    {
        return $this->price;
    }

    public function setPrice(?PriceEntity $price): void
    {
        $this->price = $price;
    }
}