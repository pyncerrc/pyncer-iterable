<?php
namespace Pyncer\Iterable;

use Countable;
use SeekableIterator;
use Pyncer\Iterable\StaticSeekableIteratorTrait;

class StaticSeekableIterator implements Countable, SeekableIterator
{
    use StaticSeekableIteratorTrait;
}
