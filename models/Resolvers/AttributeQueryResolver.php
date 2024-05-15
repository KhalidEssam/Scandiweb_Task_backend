<?php
class AttributeQueryResolver extends AbstractQueryResolver {
    public function resolve($productId) {
        $stmt = $this->pdo->prepare('
        SELECT
            a.name AS id,
            ai.displayValue AS attribute_item_value
            FROM
            product_attribute pa
            JOIN
            attribute a ON pa.attribute_id = a.id
            JOIN
            attribute_item ai ON pa.attribute_item_id = ai.id
            WHERE
            pa.product_id = :product_id;
        ');
        $stmt->execute(['product_id' => $productId]);
        $attributes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $id = '';
        $values = [];
        
        // Group attributes with the same ID together
        foreach ($attributes as $attribute) {
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