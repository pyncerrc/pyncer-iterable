<?php
namespace Pyncer\Iterable;

use Pyncer as p;
use Pyncer\Iterable\Map;
use Pyncer\Iterable\MapInterface;
use Pyncer\Iterable\Set;

use function array_key_exists;
use function count;
use function implode;
use function iterator_to_array;

class SetMap extends Map
{
    public function add(string $key, mixed ...$values): static
    {
        if (!$this->has($key)) {
            $this->values[$key] = new Set();
        }

        $this->values[$key]->add(...$values);

        return $this;
    }
    public function set(string $key, mixed $value): static
    {
        $this->values[$key] = new Set();
        $this->add($key, $value);

        return $this;
    }

    public function has(string ...$keys): bool
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $this->values) ||
                // Skip over empty sets modifed by user
                !count($this->values[$key])
            ) {
                return false;
            }
        }

        return true;
    }
    public function next(): void
    {
        ++$this->position;

        // Skip over empty sets modifed by user
        while (true) {
            if ($this->position >= count($this->keys)) {
                break;
            }

            if (count($this->values[$this->keys[$this->position]])) {
                break;
            }

            ++$this->position;
        }
    }
    public function getData(): array
    {
        $data = [];

        foreach($this->values as $key => $value) {
            // Skip over empty sets modifed by user
            if (!count($value)) {
                continue;
            }

            $data[$key] = $value;
        }

        return $data;
    }
    public function copy(): array
    {
        $copy = [];

        foreach ($this->values as $key => $value) {
            if (!count($value)) {
                continue;
            }

            $copy[$key] = $value;
        }

        return $copy;
    }
    public function count(): int
    {
        $count = 0;

        foreach ($this->values as $value) {
            if (count($value)) {
                ++$count;
            }
        }

        return $count;
    }

    public function implode(string $glue): MapInterface
    {
        $map = new Map();

        foreach ($this->values as $key => $value) {
            if (!count($value)) {
                continue;
            }

            $map->set($key, implode($glue, iterator_to_array($value, false)));
        }

        return $map;
    }
}
