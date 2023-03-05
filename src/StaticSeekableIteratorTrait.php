<?php
namespace Pyncer\Iterable;

use Pyncer\Iterable\StaticIteratorTrait;
use Pyncer\Exception\OutOfBoundsException;

use function array_key_exists;

trait StaticSeekableIteratorTrait
{
    use StaticIteratorTrait;

    public function seek(int $offset): void
    {
        if (array_key_exists($offset, static::$keys)) {
            throw new OutOfBoundsException('Invalid seek offset. (' . $offset . ')');
        }

        static::$position = $offset;
    }
}
