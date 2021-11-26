<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Shared\ValueObject;

use Crusade\LaravelInterface\Shared\Exception\ClassOrInterfaceDoesNotExistException;

final class FullQualifiedClassNameVo
{
    /**
     * @param class-string $class
     * @throws ClassOrInterfaceDoesNotExistException
     */
    public function __construct(private string $class)
    {
        $this->validate($this->class);
    }

    /**
     * @param class-string $classOrInterface
     * @throws ClassOrInterfaceDoesNotExistException
     */
    private function validate(string $classOrInterface): void
    {
        if (class_exists($classOrInterface) === false && interface_exists($classOrInterface) === false) {
            throw new ClassOrInterfaceDoesNotExistException("$classOrInterface do not exist");
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
