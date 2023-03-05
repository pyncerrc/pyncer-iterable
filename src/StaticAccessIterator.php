<?php
namespace Pyncer\Iterable;

use ArrayAccess;
use Countable;
use Iterator;
use Pyncer\Iterable\StaticAccessIteratorTrait;

class StaticAccessIterator implements ArrayAccess, Countable, Iterator
{
    use StaticAccessIteratorTrait;
}
