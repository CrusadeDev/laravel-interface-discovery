<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ValueObject;

use PhpParser\Node\Stmt\Interface_;

class InterfaceVo
{
    public function __construct(private Interface_ $interface)
    {
    }

    public function getInterfaceName(): string
    {
        return $this->interface->name->toString();
    }
}
