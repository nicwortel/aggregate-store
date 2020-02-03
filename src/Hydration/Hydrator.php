<?php
declare(strict_types=1);

namespace NicWortel\AggregateStore\Hydration;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use NicWortel\AggregateStore\Mapping\EntityMetadata;
use ReflectionProperty;
use function get_class;

final class Hydrator
{
    /**
     * @var AbstractPlatform
     */
    private $platform;

    public function __construct(AbstractPlatform $platform)
    {
        $this->platform = $platform;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function hydrate(EntityMetadata $metadata, array $data): object
    {
        $className = $metadata->getClassName();

        $entity = new $className();

        foreach ($metadata->getFields() as $field) {
            $this->setPropertyValue($entity, $field->getFieldName(), $data[$field->getColumnName()], $field->getType());
        }

        return $entity;
    }

    /**
     * @param mixed $value
     */
    private function setPropertyValue(object $entity, string $property, $value, string $type): void
    {
        $type = Type::getType($type);

        $property = new ReflectionProperty(get_class($entity), $property);
        $property->setAccessible(true);
        $property->setValue($entity, $type->convertToPHPValue($value, $this->platform));
    }
}
