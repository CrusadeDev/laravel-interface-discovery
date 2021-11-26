<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Shared\Ast\NodeTraverser;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

final class ClassTraverser extends NodeVisitorAbstract
{
    private ?Node\Stmt\Class_ $class = null;

    public function enterNode(Node $node): bool|null
    {
        if ($node instanceof Node\Stmt\Class_ === false) {
            return null;
        }

        $this->class = $node;

        return null;
    }

    public function hasClass(): bool
    {
        return $this->class !== null;
    }

    public function getClass(): Node\Stmt\Class_
    {
        return $this->class;
    }
}
