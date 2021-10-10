<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface;

use Crusade\LaravelInterface\ValueObject\ClassVo;
use Crusade\LaravelInterface\ValueObject\FullQualifiedClassNameVo;
use Crusade\LaravelInterface\ValueObject\NamespaceVo;

final class ClassFQCNBuilder
{
    public function buildFQCN(NamespaceVo $namespaceVo, ClassVo $classVo): FullQualifiedClassNameVo
    {
        return new FullQualifiedClassNameVo (
            sprintf('%s\%s', $namespaceVo->getNamespaceName(), $classVo->getClassName())
        );
    }
}
