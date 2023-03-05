<?php
namespace Pyncer\Iterable;

use Pyncer\Iterable\StaticIteratorTrait;
use Pyncer\Exception\OutOfBoundsException;

use function array_key_exists;

trait StaticAccessIteratorTrait
{
    use StaticIteratorTrait;

    // ArrayAccess implementation
    public function offsetExists($offset): bool
    {
        if (!array_key_exists($offset, static::$values)) {
            throw new OutOfBoundsException('Invalid key specified. (' . $offset . ')');
        }

        return static::$values[$offset];
    }

    public function &offsetGet(mixed $offset): mixed
    {
        return static::$values[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        static::$values[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset(static::$values[$offset]);
    }
}
