<?php
declare(strict_types=1);

namespace NicWortel\AggregateStore;

use Doctrine\DBAL\Connection;
use NicWortel\AggregateStore\Hydration\Hydrator;
use NicWortel\AggregateStore\Mapping\EntityMetadata;
use function sprintf;

final class AggregateRepository implements Repository
{
    /**
     * @var EntityMetadata
     */
    private $metadata;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var Hydrator
     */
    private $hydrator;

    public function __construct(EntityMetadata $metadata, Connection $connection, Hydrator $hydrator)
    {
        $this->metadata = $metadata;
        $this->connection = $connection;
        $this->hydrator = $hydrator;
    }

    public function add(object $aggregate): void
    {
        // TODO: Implement add() method.
    }

    /**
     * @inheritDoc
     */
    public function get($id): object
    {
        $tableName = $this->metadata->getTableName();
        $identifierColumn = $this->metadata->getIdentifierColumn();

        $statement = $this->connection->prepare(
            sprintf('SELECT * FROM %s WHERE %s = ?', $tableName, $identifierColumn)
        );
        $statement->bindValue(1, $id);
        $statement->execute();

        $data = $statement->fetch();

        return $this->hydrator->hydrate($this->metadata, $data);
    }

    public function remove(object $aggregate): void
    {
        // TODO: Implement remove() method.
    }
}
