<?php
namespace Pyncer\Iterable;

use ArrayAccess;
use Countable;
use Iterator;
use Pyncer\Utility\CompareInterface;
use Serializable;

interface MapInterface extends
    ArrayAccess,
    CompareInterface,
    Countable,
    Iterator
{
    public function get(string $key): mixed;
    public function set(string $key, mixed $value): static;
    public function delete(string ...$keys): static;
    public function has(string ...$keys): bool;

    public function getData(): array;
    public function setData(iterable ...$values): static;
    public function addData(iterable ...$values): static;

    public function getKeys(): array;
    public function getValues(): array;
    public function clear(): static;

    public function __invoke(string $key): mixed;
}
