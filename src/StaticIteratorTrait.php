<?php
namespace Pyncer\Iterable;

use ReturnTypeWillChange;

trait StaticIteratorTrait
{
    protected static int $position = 0;
    protected static array $keys;
    protected static array $values = [];

    public function rewind(): void
    {
        static::$keys = array_keys(static::$values);
        static::$position = 0;
    }

    #[ReturnTypeWillChange]
    public function current()
    {
        return static::$values[static::$keys[static::$position]];
    }

    #[ReturnTypeWillChange]
    public function key()
    {
        return static::$keys[static::$position];
    }

    public function next(): void
    {
        ++static::$position;
    }

    public function valid(): bool
    {
        if (static::$position < count(static::$keys)) {
            return true;
        }

        return false;
    }

    public function count(): int
    {
        return count(static::$values);
    }
}
