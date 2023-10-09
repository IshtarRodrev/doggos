<?php

abstract class BaseModel {
    static public abstract function getTableName();

    public abstract function getAttributes(): array;
    public abstract function validation(): bool;

    private array $errors = [];

    protected function addError($attribute, $message): void
    {
        $this->errors[$attribute] = $message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public static function findByPk(int $id)
    {
        $tableName = static::getTableName();
        $data = DatabaseManager::getInstance()->query("SELECT * FROM $tableName WHERE id = :id", [":id" => $id])->fetch(PDO::FETCH_ASSOC);

        if (!$data)
            return null;

        $model = new static();
        $model->setData($data);
        return $model;
    }
    public static function findAll(): array
    {
        $result = [];
        
        $tableName = static::getTableName();
        $stmt = DatabaseManager::getInstance()->query("SELECT * FROM $tableName");

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $item) {
            $model = new static();

            foreach ($item as $column => $value) {
                $nameMethod = "set" . ucfirst($column);

                if (!method_exists($model, $nameMethod))
                    continue;

                $model->{$nameMethod}($value);
            }

            $result[] = $model;
        }

        return $result;
    }

    public function setData($data): void
    {
        foreach ($this->getAttributes() as $attribute) {
            $nameMethod = "set" . ucfirst($attribute);

            if (!isset($data[$attribute]))
                continue;

            $this->{$nameMethod}($data[$attribute]);
        }
    }

    public function insert(): bool
    {
        if (!$this->validation())
            return false;

        $params = [];
        foreach ($this->getAttributes() as $attribute) {
            $nameMethod = "get" . ucfirst($attribute);
            $params[':' . $attribute] = $this->{$nameMethod}();
        }

        $tableName = static::getTableName();
        $sql = "INSERT INTO $tableName (" . implode(', ', $this->getAttributes()) . ") VALUES (" . implode(', ', array_keys($params)) . ")";

        return DatabaseManager::getInstance()->query($sql, $params) != null;
    }

    public function update(): bool
    {
        if (!$this->validation())
            return false;

        $params = [];
        $tableName = static::getTableName();
        $sqlValues = [];
        foreach ($this->getAttributes() as $attribute) {
            $nameMethod = "get" . ucfirst($attribute);
            $params[':' . $attribute] = $this->{$nameMethod}();
            $sqlValues[] = $attribute . ' = :' . $attribute;
        }
        $sql = "UPDATE $tableName SET " . implode(', ', $sqlValues) . " WHERE id = :id";

        return DatabaseManager::getInstance()->query($sql, $params) != null;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM $tableName WHERE id = :id";
        $params = [
            ':id' => $this->getId(),
        ];

        DatabaseManager::getInstance()->query($sql, $params) != null;
    }
}