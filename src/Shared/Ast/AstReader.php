<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Shared\Ast;

use Crusade\LaravelInterface\Shared\Ast\NodeTraverser\ClassTraverser;
use Crusade\LaravelInterface\Shared\Ast\NodeTraverser\InterfaceTraverser;
use Crusade\LaravelInterface\Shared\Ast\NodeTraverser\NamespaceTraverser;
use Crusade\LaravelInterface\Shared\ValueObject\AstRepresentation;
use Crusade\LaravelInterface\Shared\ValueObject\ClassVo;
use Crusade\LaravelInterface\Shared\ValueObject\InterfaceVo;
use Crusade\LaravelInterface\Shared\ValueObject\NamespaceVo;
use PhpParser\NodeTraverser;

final class AstReader
{
    public function __construct(private NodeTraverser $traverser)
    {
    }

    public function findNamespace(AstRepresentation $astRepresentation): ?NamespaceVo
    {
        $namespaceTraverser = new NamespaceTraverser();

        $this->traverser->addVisitor($namespaceTraverser);
        $this->traverser->traverse($astRepresentation->getStmt());

        if ($namespaceTraverser->hasNamespace() === false) {
            return null;
        }

        return new NamespaceVo($namespaceTraverser->getNamespace());
    }

    public function findClass(AstRepresentation $astRepresentation): ?ClassVo
    {
        $classTraverser = new ClassTraverser();

        $this->traverser->addVisitor($classTraverser);
        $this->traverser->traverse($astRepresentation->getStmt());

        if ($classTraverser->hasClass() === false) {
            return null;
        }

        return new ClassVo($classTraverser->getClass());
    }

    public function findInterface(AstRepresentation $astRepresentation): ?InterfaceVo
    {
        $interfaceTraverser = new InterfaceTraverser();

        $this->traverser->addVisitor($interfaceTraverser);
        $this->traverser->traverse($astRepresentation->getStmt());

        if ($interfaceTraverser->hasInterface() === false) {
            return null;
        }

        return new InterfaceVo($interfaceTraverser->getInterface());
    }
}
