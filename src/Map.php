<?php
namespace Pyncer\Iterable;

use Countable;
use Pyncer\Exception\InvalidArgumentException;
use Pyncer\Exception\OutOfBoundsException;
use Pyncer\Iterable\IteratorTrait;
use Pyncer\Iterable\MapInterface;

use function array_key_exists;
use function array_keys;
use function array_reverse;
use function array_values;

class Map implements MapInterface
{
    use IteratorTrait;

    public function __construct(iterable $values = [])
    {
        $this->setData($values);
    }

    public function get(string $key): mixed
    {
        if (!$this->has($key)) {
            throw new OutOfBoundsException('Invalid key specified. (' . $key . ')');
        }

        return $this->values[$key];
    }
    public function set(string $key, mixed $value): static
    {
        $this->values[$key] = $value;

        return $this;
    }
    public function delete(string ...$keys): static
    {
        foreach ($keys as $key) {
            unset($this->values[$key]);
        }

        return $this;
    }
    public function has(string ...$keys): bool
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $this->values)) {
                return false;
            }
        }

        return true;
    }

    public function getData(): array
    {
        return $this->values;
    }
    public function setData(iterable ...$values): static
    {
        $this->values = [];
        $this->addData(...$values);

        return $this;
    }
    public function addData(iterable ...$values): static
    {
        foreach ($values as $iterableValues) {
            foreach ($iterableValues as $key => $value) {
                $this->set($key, $value);
            }
        }

        return $this;
    }

    public function getKeys(): array
    {
        return array_keys($this->values);
    }
    public function getValues(): array
    {
        return array_values($this->getData());
    }
    public function clear(): static
    {
        $this->values = [];

        return $this;
    }

    public function reverse(): static
    {
        $this->values = array_reverse($this->values, true);

        return $this;
    }

    public function compare(mixed $with): int
    {
        if (!($with instanceof MapInterface)) {
            return -1;
        }

        return ($this->getData() <=> $with->getData());
    }

    public function __invoke(string $key): mixed
    {
        return $this->get($key);
    }

    // ArrayAccess implementation
    public function offsetExists($offset): bool
    {
        return $this->has($offset);
    }
    public function &offsetGet(mixed $offset): mixed
    {
        return $this->values[$offset];
    }
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->set($offset, $value);
    }
    public function offsetUnset(mixed $offset): void
    {
        $this->delete($offset);
    }

    public function __serialize(): array
    {
        return $this->getData();
    }
    public function __unserialize(array $data): void
    {
        $this->setData($data);
    }
}
