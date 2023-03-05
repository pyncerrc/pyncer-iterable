<?php
namespace Pyncer\Iterable;

use Pyncer\Iterable\IteratorTrait;
use Pyncer\Exception\OutOfBoundsException;

use function array_key_exists;

trait AccessIteratorTrait
{
    use IteratorTrait;

    // ArrayAccess implementation
    public function offsetExists($offset): bool
    {
        if (!array_key_exists($offset, $this->values)) {
            throw new OutOfBoundsException('Invalid key specified. (' . $offset . ')');
        }

        return $this->values[$offset];
    }

    public function &offsetGet(mixed $offset): mixed
    {
        return $this->values[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->values[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->values[$offset]);
    }
}
