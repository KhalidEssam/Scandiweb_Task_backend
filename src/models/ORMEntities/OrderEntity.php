<?php


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class OrderEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="float")
     */
    protected $totalPrice;

    /**
     * @ORM\OneToMany(targetEntity="OrderDetailEntity", mappedBy="order")
     */
    protected $orderDetails;

    public function __construct()
    {
        $this->orderDetails = new ArrayCollection();
    }

    // Getter and setter methods

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    public function getOrderDetails()
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetailEntity $orderDetail): void
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails[] = $orderDetail;
            $orderDetail->setOrder($this);
        }
    }

    public function removeOrderDetail(OrderDetailEntity $orderDetail): void
    {
        if ($this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->removeElement($orderDetail);
            // If the orderDetail is associated with this order, remove the association
            if ($orderDetail->getOrder() === $this) {
                $orderDetail->setOrder(null);
            }
        }
    }
}