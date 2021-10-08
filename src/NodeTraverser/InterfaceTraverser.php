<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\NodeTraverser;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class InterfaceTraverser extends NodeVisitorAbstract
{
    private ?Node\Stmt\Interface_ $interface = null;

    public function enterNode(Node $node): bool|null
    {
        if ($node instanceof Node\Stmt\Interface_ === false) {
            return null;
        }

        $this->interface = $node;

        return null;
    }

    public function hasInterface(): bool
    {
        return $this->interface !== null;
    }

    public function getInterface(): Node\Stmt\Interface_
    {
        return $this->interface;
    }
}
