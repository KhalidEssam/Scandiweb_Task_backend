<?php
class PDOGalleryQueryResolver extends PDOAbstractQueryResolver {
    public function resolve($productId) {
        $stmt = $this->pdo->prepare('SELECT url FROM product_image WHERE product_id = :product_id');
        $stmt->execute(['product_id' => $productId]);
        $gallery = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        $gallery_array = json_decode($gallery, true);
        $gallery_array = array_column($gallery_array, 'url');        
        return $gallery_array;
    }
}