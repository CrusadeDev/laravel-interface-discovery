<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface;

use Crusade\LaravelInterface\NodeTraverser\ClassTraverser;
use Crusade\LaravelInterface\NodeTraverser\InterfaceTraverser;
use Crusade\LaravelInterface\NodeTraverser\NamespaceTraverser;
use Crusade\LaravelInterface\ValueObject\AstRepresentation;
use Crusade\LaravelInterface\ValueObject\ClassVo;
use Crusade\LaravelInterface\ValueObject\InterfaceVo;
use Crusade\LaravelInterface\ValueObject\NamespaceVo;
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
