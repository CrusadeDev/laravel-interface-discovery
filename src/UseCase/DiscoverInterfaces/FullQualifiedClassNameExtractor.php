<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\UseCase\DiscoverInterfaces;

use Crusade\LaravelInterface\Shared\Ast\AstReader;
use Crusade\LaravelInterface\Shared\Builder\ClassFQCNBuilder;
use Crusade\LaravelInterface\Shared\Exception\ClassOrInterfaceDoesNotExistException;
use Crusade\LaravelInterface\Shared\ValueObject\FileContent;
use Crusade\LaravelInterface\Shared\ValueObject\FullQualifiedClassNameVo;
use Crusade\LaravelInterface\UseCase\DiscoverInterfaces\Ast\FileParser;

final class FullQualifiedClassNameExtractor
{
    public function __construct(
        private FileParser $fileParser,
        private AstReader $astReader,
        private ClassFQCNBuilder $classFQCNBuilder
    ) {
    }

    /**
     * @throws ClassOrInterfaceDoesNotExistException
     */
    public function extractNamespaceFromAst(FileContent $file): ?FullQualifiedClassNameVo
    {
        $ast = $this->fileParser->parse($file);
        $namespace = $this->astReader->findNamespace($ast);

        if ($namespace === null) {
            return null;
        }

        $interfaceName = $this->astReader->findInterface($ast);

        if ($interfaceName === null) {
            return null;
        }

       return $this->classFQCNBuilder->buildFQCN($namespace, $interfaceName);
    }
}
