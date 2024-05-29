<?php

use GraphQL\Error\UserError;

class CreateOrder extends AbstractQueryResolver {
    private $orderService;

public function __construct(Doctrine\ORM\EntityManager $entityManager, OrderService $orderService)
    {
        parent::__construct($entityManager);
        $this->orderService = $orderService;
    }

    public function resolve($args)
    {
    // Validate input before starting the transaction
    $this->validateInput($args['input']);

        try {
            $this->entityManager->beginTransaction();

            $order = $this->orderService->createOrder($args['input']);

            $this->entityManager->flush();
            $this->entityManager->commit();

            return [
            'id' => $order->getId(),
            'status' => 'success'
            ];
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            error_log('Error creating orders: ' . $e->getMessage());
            throw new UserError('Error creating order: ' . $e->getMessage());
        }
    }

    private function validateInput($input)
    {
        if (count($input['items']) < 1 || ($input['totalPrice']===null)) 
        { 
            throw new UserError('Input is not set'); 
        } 
    } 
}