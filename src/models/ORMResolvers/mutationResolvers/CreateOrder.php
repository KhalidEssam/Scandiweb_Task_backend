<?php



class CreateOrder extends AbstractQueryResolver {

    public function resolve($args)
    {
        $response = ['id' => false, 'status' => ''];
        
        try {
            $this->entityManager->beginTransaction();
            
            $order = new OrderEntity();
            $order->setTotalPrice($args['input']['totalPrice']);
            $this->entityManager->persist($order);
            
            foreach ($args['input']['items'] as $item) {
                // print_r($item);
                $product = $this->entityManager->getRepository(Product::class)->findOneBy(['id' => $item['id']]);


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

            $this->entityManager->flush();
            $this->entityManager->commit();
            
            $response['id'] = $order->getId();
            $response['status'] = 'sucess';
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $response['status'] = 'Error creating orders: ' . $e->getMessage();
            // Log the error for debugging
            error_log('Error creating orders: ' . $e->getMessage());
        }
        
        return $response;
    }

}