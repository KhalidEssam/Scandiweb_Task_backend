<?php

class AttributeQueryResolver extends AbstractQueryResolver {

    public function resolve($productId) {
        $query = $this->entityManager->createQuery('
        SELECT a.name AS id, ai.displayValue AS attribute_item_value , ai.value AS attribute_value
        FROM Product_Attribute pa
        JOIN pa.attribute_id a
        JOIN pa.attribute_item_id ai
        WHERE pa.product_id = :product_id
        ')->setParameter('product_id', $productId);
        
        $result = $query->getResult();

        
        // Initialize an empty array to hold the grouped data
        $ids = [];
        $values = [];
        $displayValues = [];
        
        // Group attributes by ID
        foreach ($result as $attribute) {

            $id = $attribute['id'];
            $value = $attribute['attribute_value'];
            $displayValue = $attribute['attribute_item_value'];
            
            $ids[] = $id;
            $values[] = $value;
            $displayValues[] = $displayValue;
    
        }

        $groupedData = [array_values($ids), array_values($values) , array_values($displayValues)];
        $keys = ['id', 'value', 'displayValue'];
        $groupedData = array_combine($keys, $groupedData);

        
        $values = array_values($groupedData['value']);  
        $displayValues = array_values($groupedData['displayValue']);

        $ids = array_values($groupedData['id']);


        $groupedData = ['id' => $ids, 'value' => $values, 'displayValue' => $displayValues];


        return $groupedData;
    }


}

?>