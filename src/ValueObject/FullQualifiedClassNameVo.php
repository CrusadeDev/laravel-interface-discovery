<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ValueObject;

final class FullQualifiedClassNameVo
{
    /**
     * @param class-string $class
     */
    public function __construct(private string $class)
    {
        $this->validate($this->class);
    }

    /**
     * @param class-string $classOrInterface
     */
    private function validate(string $classOrInterface): void
    {
        if (class_exists($classOrInterface) === false && interface_exists($classOrInterface) === false) {
            throw new \LogicException("$classOrInterface do not exist");
        }
    }

    /**
     * @return class-string
     */
    public function toString(): string
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
