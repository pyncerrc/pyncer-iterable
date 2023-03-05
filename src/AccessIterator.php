<?php
namespace Pyncer\Iterable;

use ArrayAccess;
use Countable;
use Iterator;
use Pyncer\Iterable\AccessIteratorTrait;

class AccessIterator implements ArrayAccess, Countable, Iterator
{
    use AccessIteratorTrait;
}
