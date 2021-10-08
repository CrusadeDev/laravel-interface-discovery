<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ValueObject;

class FullQualifiedClassNameVo
{
    /**
     * @param class-string $class
     */
    public function __construct(private string $class)
    {
        $this->validate($this->class);
    }

    /**
     * @param class-string $class
     */
    private function validate(string $class): void
    {
        if (class_exists($class) === false) {
            throw new \LogicException("$class do not exist");
        }
    }

    /**
     * @return class-string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return class-string
     */
    public function __toString(): string
    {
        return $this->class;
    }
}
