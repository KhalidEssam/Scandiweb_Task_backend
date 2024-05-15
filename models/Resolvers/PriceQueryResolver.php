<?php
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