<?php

declare(strict_types=1);

namespace App\Domain\Collections;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use Traversable;

use function count;

/**
 * @implements IteratorAggregate<int, T>
 *
 * @template T
 */
abstract class AbstractObjectCollection implements Countable, IteratorAggregate, JsonSerializable
{
    /**
     * @var list<T>
     */
    private array $elements = [];

    /**
     * @param T ...$elements
     */
    public function __construct(...$elements)
    {
        $this->add(...$elements);
    }

    /**
     * @param T ...$elements
     */
    public function add(...$elements): void
    {
        foreach ($elements as $element) {
            $this->elements[] = $element;
        }
    }

    /**
     * @return list<T>
     */
    final public function all(): array
    {
        return $this->elements;
    }

    final public function count(): int
    {
        return count($this->elements);
    }

    /**
     * @return Traversable<int, T>
     */
    final public function getIterator(): Traversable
    {
        return new ArrayIterator($this->elements);
    }

    /**
     * @return list<T>
     */
    final public function jsonSerialize(): array
    {
        return $this->elements;
    }
}
