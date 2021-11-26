<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Shared\ValueObject;

use PhpParser\Node\Stmt\Interface_;

final class InterfaceVo implements ClassOrInterfaceInterface
{
    public function __construct(private Interface_ $interface)
    {
    }

    public function toString(): string
    {
        return $this->interface->name->toString();
    }
}
