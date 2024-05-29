<?php
class GalleryQueryResolver extends AbstractQueryResolver {
    public function resolve($productId) {
        $query = $this->entityManager->createQuery(
            'SELECT g
            FROM product_image g
            WHERE g.product_id = :product_id'
        )->setParameter('product_id', $productId);

        $urls = $query->getResult();
        $gallery = [];
        foreach ($urls as $img) {
            $gallery[] = $img->getUrl();
        }   
        return $gallery;
    }
}