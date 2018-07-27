<?php
declare(strict_types=1);

namespace NicWortel\AggregateStore;

/**
 * Interface for a collection-oriented aggregate repository
 */
interface Repository
{
    public function add(object $aggregate): void;

    /**
     * @param mixed $id
     *
     * @return object
     *
     * @throws AggregateNotFoundException
     */
    public function get($id): object;

    public function remove(object $aggregate): void;
}
