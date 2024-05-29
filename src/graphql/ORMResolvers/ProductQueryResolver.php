<?php


class ProductQueryResolver extends AbstractQueryResolver {
    public function resolve($productId =0) {
        $query = $this->entityManager->createQuery('SELECT p FROM Product p');

        // // Execute the query
        $products = $query->getResult();
        $ProductArray = [];
        foreach ($products as $productData) {
            $ProductArray  [] = [
                'id' => $productData->getId(),
                'name' => $productData->getName(),
                'inStock' => $productData->getInStock(),
                'description' => $productData->getDescription(),
                'brand' => $productData->getBrand(),
                'category_id' => $productData->getCategory(),
                'price_id' => $productData->getPrice()
                
            ];
        }

        return $ProductArray;
    }
}