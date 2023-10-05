<?php

declare(strict_types=1);

namespace App\Domain\Collections;

use InvalidArgumentException;

use function ceil;

/**
 * @extends AbstractObjectCollection<T>
 *
 * @template T
 */
abstract class AbstractPaginatedObjectCollection extends AbstractObjectCollection
{
    public function __construct(
        private int $total,
        private int $perPage,
        private int $page,
        ...$elements,
    )
    {
        parent::__construct($elements);
    }

    public function getTotal(): int
    {
        return $this->total ?? $this->count();
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
