<?php


abstract class AbstractQueryResolver {
    protected $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    abstract public function resolve($productId);
}

class CategoryQueryResolver extends AbstractQueryResolver {
    public function resolve($productId ) {
        $stmt = $this->pdo->query('SELECT * FROM categories');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class ProductQueryResolver extends AbstractQueryResolver {
    public function resolve($productId) {
        $stmt = $this->pdo->query('SELECT * FROM products');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class GalleryQueryResolver extends AbstractQueryResolver {
    public function resolve($productId) {
        $stmt = $this->pdo->prepare('SELECT url FROM product_image WHERE product_id = :product_id');
        $stmt->execute(['product_id' => $productId]);
        $gallery = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        $gallery_array = json_decode($gallery, true);
        $gallery_array = array_column($gallery_array, 'url');        
        return $gallery_array;
    }
}

class CategoryNameQueryResolver extends AbstractQueryResolver {
    public function resolve($categoryId) {
        // echo $categoryId;
        $stmt = $this->pdo->prepare('SELECT name FROM categories WHERE id = :category_id');
        $stmt->execute(['category_id' => $categoryId]);
        $category_name = $stmt->fetchColumn();
        // echo $category_name;
        return $category_name;
    }
}

class PriceQueryResolver extends AbstractQueryResolver {
    public function resolve($priceId) {
        // echo $priceId;
        $stmt = $this->pdo->prepare('SELECT
        p.amount,
        c.label AS currency_name,
        c.symbol
        FROM
        prices p
        JOIN
        currencies c ON p.currency_id = c.id
        WHERE
        p.id = :price_id
        ');
        $stmt->execute(['price_id' => $priceId]);
        $price_details = $stmt->fetch(PDO::FETCH_ASSOC);
        return $price_details;
    }
}

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


        // print_r ($groupedData);








        return $groupedData;
    }
}

?>