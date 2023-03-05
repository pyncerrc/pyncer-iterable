<?php
namespace Pyncer\Iterable;

use Countable;
use SeekableIterator;
use Pyncer\Iterable\AccessIteratorTrait;

class SeekableIterator implements Countable, SeekableIterator
{
    use SeekableIteratorTrait;
}
