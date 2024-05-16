<?php


class AttributeQueryResolver extends AbstractQueryResolver {
    

    public function resolve($productId) {
        $query = $this->entityManager->createQuery('
        SELECT a.name AS id, ai.displayValue AS attribute_item_value
        FROM Product_Attribute pa
        JOIN pa.attribute_id a
        JOIN pa.attribute_item_id ai
        WHERE pa.product_id = :product_id
        ')->setParameter('product_id', $productId);
        $result = $query->getResult();
        
        // print_r($result);

        $id = '';
        $values = [];
        
        // Group attributes with the same ID together
        foreach ($result as $attribute) {
        $id = $attribute['id'];
        $value = $attribute['attribute_item_value'];
        
        $values[] = $value;
        }
        
        // Now $ids contains all the unique attribute IDs and $values contains the corresponding values
        $groupedData = [$id, array_values($values)];
        $keys = ['id', 'value'];
        $groupedData = array_combine($keys, $groupedData);

        $values = array_values($groupedData['value']);
        $groupedData = ['id' => $id, 'value' => $values];
        return $groupedData;
    }
}

?>