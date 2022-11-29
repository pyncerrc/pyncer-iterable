<?php
namespace Pyncer\Iterable;

use Pyncer\Iterable\IteratorTrait;
use Pyncer\Exception\OutOfBoundsException;

use function array_key_exists;

trait SeekableIteratorTrait
{
    use IteratorTrait;

    public function seek(int $offset): void
    {
        if (array_key_exists($offset, $this->values)) {
            throw new OutOfBoundsException('Invalid seek offset. (' . $offset . ')');
        }

        $this->position = $offset;
    }
}
