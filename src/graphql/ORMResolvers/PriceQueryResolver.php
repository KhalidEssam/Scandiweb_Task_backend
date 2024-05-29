<?php
class PriceQueryResolver extends AbstractQueryResolver {
    public function resolve($priceId) {
        $query = $this->entityManager->createQuery('
        SELECT p.amount,
        c.label  AS currency_name,
        c.symbol
        FROM PriceEntity p
        JOIN p.currency_id c
        WHERE p.id = :price_id
        ')->setParameter('price_id', $priceId);
        
        $priceDetails = $query->getOneOrNullResult();

        return $priceDetails;
    }
}