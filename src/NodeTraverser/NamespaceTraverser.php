<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\NodeTraverser;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

final class NamespaceTraverser extends NodeVisitorAbstract
{
    private ?Node\Stmt\Namespace_ $namespace = null;

    public function enterNode(Node $node): bool|null
    {
        if ($node instanceof Node\Stmt\Namespace_ === false) {
            return null;
        }

        $this->namespace = $node;

        return null;
    }

    public function hasNamespace(): bool
    {
        return $this->namespace !== null;
    }

    public function getNamespace(): Node\Stmt\Namespace_
    {
        return $this->namespace;
    }
}
