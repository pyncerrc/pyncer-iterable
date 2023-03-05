<?php
namespace Pyncer\Iterable;

use Pyncer\Exception\InvalidArgumentException;
use Pyncer\Iterable\SeekableIteratorTrait;
use Pyncer\Iterable\SetInterface;
use Pyncer\Utility\CompareInterface;

use function array_reverse;
use function implode;

class Set implements SetInterface
{
    use SeekableIteratorTrait;

    public function __construct(iterable $values = [])
    {
        $this->add(...$values);
    }

    public function add(mixed ...$values): static
    {
        foreach ($values as $value) {
            if (!$this->has($value)) {
                $this->values[] = $value;
            }
        }

        return $this;
    }

    public function delete(mixed ...$values): static
    {
        foreach ($values as $value1) {
            foreach ($this->values as $key2 => $value2) {
                if ($value1 instanceof CompareInterface) {
                    if ($value1->compare($value2) === 0) {
                        unset($this->values[$key2]);
                        break;
                    }
                } elseif ($value2 instanceof CompareInterface) {
                    if ($value2->compare($value1) === 0) {
                        unset($this->values[$key2]);
                        break;
                    }
                } elseif ($value1 === $value2) {
                    unset($this->values[$key2]);
                    break;
                }
            }
        }

        return $this;
    }

    public function has(mixed ...$values): bool
    {
        $result = true;

        foreach ($values as $value1) {
            $found = false;

            foreach ($this->values as $key2 => $value2) {
                if ($value1 instanceof CompareInterface) {
                    if ($value1->compare($value2) === 0) {
                        $found = true;
                        break;
                    }
                } elseif ($value2 instanceof CompareInterface) {
                    if ($value2->compare($value1) === 0) {
                        $found = true;
                        break;
                    }
                } elseif ($value1 === $value2) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $result = false;
            }
        }

        return $result;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function clear(): static
    {
        $this->values = [];

        return $this;
    }

    public function reverse(): static
    {
        $this->values = array_reverse($this->values);

        return $this;
    }

    public function implode(string $glue): string
    {
        return implode($glue, $this->values);
    }

    public function compare(mixed $with): int
    {
        if (!$with instanceof SetInterface) {
            return -1;
        }

        return ($this->getValues() <=> $with->getValues());
    }

    public function __serialize(): array
    {
        return $this->values;
    }
    public function __unserialize(array $data): void
    {
        $this->values = [];
        $this->add(...$data);
    }
}
