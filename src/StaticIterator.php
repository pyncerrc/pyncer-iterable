<?php
namespace Pyncer\Iterable;

use Countable;
use Iterator;
use Pyncer\Iterable\StaticIteratorTrait;

class StaticIterator implements Countable, Iterator
{
    use StaticIteratorTrait;
}
