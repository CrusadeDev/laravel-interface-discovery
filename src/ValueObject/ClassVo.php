<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ValueObject;

use PhpParser\Node\Stmt\Class_;

class ClassVo
{
    public function __construct(private Class_ $class)
    {
    }

    public function getClassName(): string
    {
        return $this->class->name->toString();
    }
}
