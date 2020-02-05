<?php
declare(strict_types=1);

namespace NicWortel\AggregateStore\Mapping;

final class EntityMetadata
{
    /**
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $tableName;

    /**
     * @var Field[]
     */
    private $fields = [];

    public function __construct(string $className, string $tableName)
    {
        $this->className = $className;
        $this->tableName = $tableName;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function setIdentifier(string $propertyName, string $columnName, string $type): void
    {
        $this->fields[] = new Field($propertyName, $columnName, $type);
    }

    public function addField(string $propertyName, string $columnName, string $type): void
    {
        $this->fields[] = new Field($propertyName, $columnName, $type);
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
