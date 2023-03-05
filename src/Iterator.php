<?php
namespace Pyncer\Iterable;

use Countable;
use Iterator as PhpIterator;
use Pyncer\Iterable\IteratorTrait;

class Iterator implements Countable, PhpIterator
{
    use IteratorTrait;
}
