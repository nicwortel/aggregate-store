<?php
declare(strict_types=1);

namespace NicWortel\AggregateStore\Tests\System;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Synchronizer\SingleDatabaseSynchronizer;
use NicWortel\AggregateStore\AggregateRepository;
use NicWortel\AggregateStore\Hydration\Hydrator;
use NicWortel\AggregateStore\Mapping\EntityMetadata;
use NicWortel\AggregateStore\Tests\System\TestDouble\Book;
use PHPUnit\Framework\TestCase;

class AggregateRepositoryTest extends TestCase
{
    private const TABLE_NAME = 'aggregates';

    /**
     * @var Connection
     */
    private $dbalConnection;

    protected function setUp(): void
    {
        $this->dbalConnection = DriverManager::getConnection(
            [
                'dbname' => 'test',
                'user' => 'user',
                'password' => 'password',
                'host' => '127.0.0.1',
                'driver' => 'pdo_mysql',
            ]
        );

        $schema = new Schema();

        $table = $schema->createTable(self::TABLE_NAME);
        $table->addColumn('id', 'integer');
        $table->addColumn('isbn', 'string');
        $table->addColumn('title', 'string');
        $table->addColumn('author', 'string');

        $schemaManager = new SingleDatabaseSynchronizer($this->dbalConnection);

        $schemaManager->dropAllSchema();
        $schemaManager->createSchema($schema);
    }

    public function testLoadsAggregateFromTheDatabase(): void
    {
        $this->dbalConnection->insert(
            self::TABLE_NAME,
            [
                'id' => 1,
                'isbn' => '9780321125217',
                'title' => 'Domain-Driven Design',
                'author' => 'Eric Evans',
            ]
        );

        $metadata = new EntityMetadata(Book::class, self::TABLE_NAME);
        $metadata->setIdentifier('id', 'id', 'integer');
        $metadata->addField('isbn', 'isbn', 'string');
        $metadata->addField('title', 'title', 'string');
        $metadata->addField('author', 'author', 'string');

        $repository = new AggregateRepository(
            $metadata,
            $this->dbalConnection,
            new Hydrator($this->dbalConnection->getDatabasePlatform())
        );

        /** @var Book $aggregate */
        $aggregate = $repository->get(1);

        $this->assertInstanceOf(Book::class, $aggregate);
        $this->assertSame(1, $aggregate->getId());
        $this->assertSame('9780321125217', $aggregate->getIsbn());
        $this->assertSame('Domain-Driven Design', $aggregate->getTitle());
        $this->assertSame('Eric Evans', $aggregate->getAuthor());
    }
}
