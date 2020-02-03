<?php
declare(strict_types=1);

namespace NicWortel\AggregateStore\Tests\System\TestDouble;

final class Book
{
    /**
     * @var int
     */
    private $id;

    public function getId(): int
    {
        return $this->id;
    }
}
