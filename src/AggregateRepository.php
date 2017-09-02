<?php
declare(strict_types=1);

namespace NicWortel\AggregateStore;

/**
 * Interface for a collection-oriented aggregate repository
 */
interface AggregateRepository
{
    /**
     * @param object $aggregate
     *
     * @return void
     */
    public function add($aggregate): void;

    /**
     * @param mixed $id
     *
     * @return object
     * @throws AggregateNotFoundException
     */
    public function get($id);

    /**
     * @param object $aggregate
     *
     * @return void
     */
    public function remove($aggregate): void;
}
