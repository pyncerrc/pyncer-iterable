<?php
namespace Pyncer\Iterable;

use Countable;
use SeekableIterator as PhpSeekableIterator;
use Pyncer\Iterable\SeekableIteratorTrait;

class SeekableIterator implements Countable, PhpSeekableIterator
{
    use SeekableIteratorTrait;
}
