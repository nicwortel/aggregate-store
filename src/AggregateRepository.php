<?php
declare(strict_types=1);

namespace NicWortel\AggregateStore;

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
     */
    public function get($id);

    /**
     * @param object $aggregate
     *
     * @return void
     */
    public function remove($aggregate): void;
}
