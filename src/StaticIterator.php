<?php
namespace Pyncer\Iterable;

use Countable;
use Iterator;
use Pyncer\Iterable\StaticIteratorTrait;

class StaticAccessIterator implements Countable, Iterator
{
    use StaticIteratorTrait;
}
