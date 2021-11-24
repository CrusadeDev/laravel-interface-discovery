<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface;

use Crusade\LaravelInterface\ValueObject\ClassOrInterfaceInterface;
use Crusade\LaravelInterface\ValueObject\FullQualifiedClassNameVo;
use Crusade\LaravelInterface\ValueObject\NamespaceVo;

final class ClassFQCNBuilder
{
    /**
     * @throws Exception\ClassOrInterfaceDoesNotExistException
     */
    public function buildFQCN(NamespaceVo $namespaceVo, ClassOrInterfaceInterface $classVo): FullQualifiedClassNameVo
    {
        return new FullQualifiedClassNameVo (
            sprintf('%s\%s', $namespaceVo->getNamespaceName(), $classVo->toString())
        );
    }
}
