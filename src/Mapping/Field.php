<?php
declare(strict_types=1);

namespace NicWortel\AggregateStore\Mapping;

final class Field
{
    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var string
     */
    private $columnName;

    /**
     * @var string
     */
    private $type;

    public function __construct(string $fieldName, string $columnName, string $type)
    {
        $this->fieldName = $fieldName;
        $this->columnName = $columnName;
        $this->type = $type;
    }

    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    public function getColumnName(): string
    {
        return $this->columnName;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
