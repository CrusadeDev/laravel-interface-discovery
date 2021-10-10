<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ValueObject;

use PhpParser\Node\Stmt\Class_;

final class ClassVo implements ClassOrInterfaceInterface
{
    public function __construct(private Class_ $class)
    {
    }

    public function toString(): string
    {
        return $this->class->name->toString();
    }
}
