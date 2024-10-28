<?php

namespace Project\Models;

use Project\Services\Db;


abstract class ActiveRecordEntity
{
    protected $id;

    public function getId(): int
    {
        return $this->id;
    }

    public static function getById(int $id)
    {
        $db = Db::getInstance();
        $entities = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;', [':id' => $id], static::class);
        return $entities ? $entities[0] : null;
    }

    public static function findAll(): array
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    public static function loadComments(int $articleId)
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE acticle_id=:id ;', [':id' => $articleId], static::class);
    }


    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();

        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }

    private function update(array $mappedProperties): void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;

        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index; // :param1
            $columns2params[] = $column . ' = ' . $param; // column1 = :param1
            $params2values[$param] = $value; // [:param1 => value1]
            $index++;
        }

        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    private function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);
        $columns = [];
        $paramsNames = [];
        $params2values = [];

        foreach ($filteredProperties as $columnName => $value) {
            $columns[] = '`' . $columnName . '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }

        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';

        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    public function delete()
    {
        $db = Db::getInstance();
        $db->query(
            'DELETE FROM `' . static::getTableName() . '` WHERE id = :id',
            [':id' => $this->id]
        );
        $this->id = null;
    }

    public function deleteActivationCode()
    {
        $db = Db::getInstance();
        $db->query(
            'DELETE FROM `users_activation_codes` WHERE user_id = :id',
            [':id' => $this->id]
        );
    }


    // Костыль
    public static function getLastId(): int
    {
        $db = Db::getInstance();
        $result = $db->query('SELECT  LAST_INSERT_ID() AS id;', [], static::class);
        return ($result[0]->getId());
    }

    public function saveComment(
        $authorId, $articleId, $text
    )
    {
        $db = Db::getInstance();
        $db->query('INSERT INTO `comments` (text, acticle_id, author_id) VALUE ("' . $text . '", ' . $articleId . ', ' . $authorId .');');
    }

    public function saveArticle(
        $authorId, $name, $text
    )
    {
        $db = Db::getInstance();
        $db->query('INSERT INTO `articles` (author_id, name, text) VALUE ("' . $authorId . '", ' . $name . ', ' . $text .');');
    }

    public function editComment($text, $commentId)
    {
        $db = Db::getInstance();
        $sql = 'UPDATE `comments` SET `text`="' . $text . '" WHERE id=' . $commentId . ';';
        $db->query($sql);
    }


    // Duplicate validation
    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
            [':value' => $value],
            static::class
        );

        if ($result === []) {
            return null;
        }

        return $result[0];
    }


    // Additional methods
    public function __set(string $name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $mappedProperties = [];

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }

        return $mappedProperties;
    }

    abstract protected static function getTableName(): string;
}