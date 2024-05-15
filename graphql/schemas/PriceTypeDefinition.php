<?php

declare(strict_types=1);

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;


class PriceType extends BaseType
{
    public function __construct()
    {
        $name = 'Price';
        $fields = [
            'amount' => Type::float(),
            'currency' => [
                'type' => (new CurrencyType())->getType(),
                'resolve' => function ($parent) {
                    return [
                        'label' => $parent['currency_name'],
                        'symbol' => $parent['symbol']
                    ];
                }
            ],
        ];

        parent::__construct($name, $fields);
    }
}