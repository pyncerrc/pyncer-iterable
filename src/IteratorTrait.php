<?php
namespace Pyncer\Iterable;

trait IteratorTrait
{
    protected int $position = 0;
    protected array $keys;
    protected array $values = [];

    public function rewind(): void
    {
        $this->keys = array_keys($this->values);
        $this->position = 0;
    }

    #[\ReturnTypeWillChange]
    public function current()
    {
        return $this->values[$this->keys[$this->position]];
    }

    #[\ReturnTypeWillChange]
    public function key()
    {
        return $this->keys[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        if ($this->position < count($this->keys)) {
            return true;
        }

        return false;
    }

    public function count(): int
    {
        return count($this->values);
    }
}
