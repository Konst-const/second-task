<?php

/**
 * @property string $name_product
 * @property string $code_product
 */
class Product extends Model
{
    protected $fields = [
        'id_product',
        'name_product',
        'code_product',
    ];

    protected $prices = [];
    protected $properts = [];

    public function getTable(): string
    {
        return 'a_product';
    }

    public function getPrimaryKey(): string
    {
        return 'id_product';
    }

    public function addPrice(Price $price): self
    {
        $this->prices[] = $price;

        return $this;
    }
    public function addProperty(Property $property): self
    {
        $this->properts[] = $property;

        return $this;
    }

    /**
     * @return array<Price>
     */
    public function getPrices(): array
    {
        return $this->prices;
    }
    public function getProperts(): array
    {
        return $this->properts;
    }

}