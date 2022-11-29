<?php
namespace Pyncer\Iterable;

use Pyncer\Iterable\Map;
use Pyncer\Iterable\MapInterface;

use function array_merge;

class ArrayMap extends Map
{
    public function add(string $key, mixed ...$values): static
    {
        if (!$this->has($key)) {
            $this->values[$key] = [];
        }

        // TODO: Suxp comparator interface
        // Not sure what suxp was supposed to be
        $this->values[$key] = array_merge($this->values[$key], $values);

        return $this;
    }
    public function set(string $key, mixed $value): static
    {
        $this->values[$key] = [];
        $this->add($key, $value);

        return $this;
    }

    public function implode(string $glue): MapInterface
    {
        $map = new Map();

        foreach ($this->values as $key => $value) {
            $map->set($key, implode($glue, $value));
        }

        return $map;
    }
}
