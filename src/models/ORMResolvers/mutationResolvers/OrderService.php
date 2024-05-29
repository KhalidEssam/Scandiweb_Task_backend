<?php
use GraphQL\Error\UserError;

class OrderService {

    private $entityManager;

    public function __construct(Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createOrder($input)
    {
        $order = new OrderEntity();
        $order->setTotalPrice($input['totalPrice']);
        $this->entityManager->persist($order);
        
        foreach ($input['items'] as $item) {
            $product = $this->entityManager->getRepository(Product::class)->find($item['id']);      
            if (!$product) {
            throw new UserError('Product not found: ' . $item['id']);
            }      
            if($item['attributes'] == null) {
                $orderDetail = new OrderDetailEntity();
                $orderDetail->setOrder($order);
                $orderDetail->setProduct($product);
                $orderDetail->setCount($item['count']);
                $this->entityManager->persist($orderDetail);
            }
            else {
                foreach ($item['attributes'] as $attr) {
                    $orderDetail = new OrderDetailEntity();
                    $orderDetail->setOrder($order);
                    $orderDetail->setProduct($product);
                    $orderDetail->setCount($item['count']);
                    
                    $attribute = $this->entityManager->getRepository(AttributeEntity::class)->findOneBy(['name' => $attr['id']]);
                    $selectedAttribute = $this->entityManager->getRepository(AttributeItem::class)->findOneBy([
                    'attribute_id' => $attribute->getId(),
                    'value' => $attr['value'],
                    ]);
                    if ($selectedAttribute) {
                    
                        
                        $orderDetail->setSelectedAttribute($selectedAttribute);
                        $this->entityManager->persist($orderDetail);
                    }
                }
            }
        }
        return $order;
    }
}