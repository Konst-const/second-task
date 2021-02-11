<?php


class Property extends Model
{
    protected $fields = [
        'id',
        'id_product',
        'name_property',
        'value_property',
    ];

    public function getTable(): string
    {
        return 'a_property';
    }

    public function getPrimaryKey(): string
    {
        return 'id';
    }

    public static function make(string $name, string $value): self
    {
        $instance = new static();
        $instance->name_property = $name;
        $instance->value_property = $value;

        return $instance;
    }
}