<?php
declare(strict_types=1);

namespace NicWortel\AggregateStore\Tests\System\TestDouble;

final class Book
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $isbn;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    public function getId(): int
    {
        return $this->id;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
}
