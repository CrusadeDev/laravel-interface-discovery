<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Shared\ValueObject;

use PhpParser\Node\Stmt\Namespace_;

final class NamespaceVo
{
    public function __construct(private Namespace_ $namespace)
    {
    }

    public function getNamespaceName(): string
    {
        return $this->namespace->name->toString();
    }
}
