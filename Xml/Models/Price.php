<?php

/**
 * @property int $id
 * @property int $id_product
 * @property string $type_price
 * @property int $price
 */
class Price extends Model
{
    protected $fields = [
        'id',
        'id_product',
        'type_price',
        'price',
    ];

    public function getTable(): string
    {
        return 'a_price';
    }

    public function getPrimaryKey(): string
    {
        return 'id';
    }

    public static function make(string $type, int $price): self
    {
        $instance = new static();
        $instance->type_price = $type;
        $instance->price = $price;

        return $instance;
    }
}