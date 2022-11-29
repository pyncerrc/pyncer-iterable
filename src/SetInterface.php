<?php
namespace Pyncer\Iterable;

use Countable;
use Pyncer\Utility\CompareInterface;
use SeekableIterator;

interface SetInterface extends
    CompareInterface,
    Countable,
    SeekableIterator
{
    public function add(mixed ...$values): static;
    public function delete(mixed ...$values): static;
    public function has(mixed ...$values): bool;

    public function getValues(): array;
    public function clear(): static;
}
