<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Shared\Builder;

use Crusade\LaravelInterface\Shared\Exception;
use Crusade\LaravelInterface\Shared\ValueObject\ClassOrInterfaceInterface;
use Crusade\LaravelInterface\Shared\ValueObject\FullQualifiedClassNameVo;
use Crusade\LaravelInterface\Shared\ValueObject\NamespaceVo;

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
