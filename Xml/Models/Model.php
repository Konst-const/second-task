<?php

abstract class Model
{
    protected $fields;

    protected $attributes;

    abstract public function getTable(): string;

    abstract public function getPrimaryKey(): string;

    public function getIdentifier()
    {
        return $this->attributes[$this->getPrimaryKey()] ?? null;
    }

    public function insert(\PDO $connection): self
    {
        $values = $this->attributes;
        unset($values[$this->getPrimaryKey()]);
        $fields = array_keys($values);

        $sql = "INSERT INTO `" . $this->getTable() . "` (" . implode(',', $fields) . ") VALUES(" . $this->buildValuesToInsert($values) . ")";

        $connection->query($sql);

        return $this->setAttribute($this->getPrimaryKey(), $connection->lastInsertId());
    }

    public function setAttribute(string $field, $value): self
    {
        $this->attributes[$field] = $value;

        return $this;
    }

    public function getAttribute(string $field)
    {
        return $this->attributes[$field] ?? null;
    }

    public function __set($name, $value)
    {
        $this->setAttribute($name, $value);
    }

    public function __get($name)
    {
        return $this->getAttribute($name);
    }

    private function buildValuesToInsert(array $values): string
    {
        return implode(',', array_map(function ($value) {
            return "'{$value}'";
        }, $values));
    }
}