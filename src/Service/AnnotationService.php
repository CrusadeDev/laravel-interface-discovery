<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Service;

use Crusade\LaravelInterface\AstReader;
use Crusade\LaravelInterface\ConnectAnnotationFinder;
use Crusade\LaravelInterface\ClassFQCNBuilder;
use Crusade\LaravelInterface\Exception\AttributeDoesNotContainsRequiredArgumentsException;
use Crusade\LaravelInterface\Exception\ClassOrInterfaceDoesNotExistException;
use Crusade\LaravelInterface\Exception\ImplementationMustBeAClassException;
use Crusade\LaravelInterface\Exception\InterfaceImplementsMultipleConnectionAnnotationException;
use Crusade\LaravelInterface\FileParser;
use Crusade\LaravelInterface\ValueObject\FileContent;
use Crusade\LaravelInterface\ValueObject\FoundAnnotation;

final class AnnotationService
{
    public function __construct(
        private FileParser $fileParser,
        private AstReader $astReader,
        private ConnectAnnotationFinder $attributeFinder,
        private ClassFQCNBuilder $classFQCNBuilder
    ) {
    }

    /**
     * @throws AttributeDoesNotContainsRequiredArgumentsException
     * @throws ClassOrInterfaceDoesNotExistException
     * @throws ImplementationMustBeAClassException
     * @throws InterfaceImplementsMultipleConnectionAnnotationException
     */
    public function findConnectAnnotation(FileContent $file): ?FoundAnnotation
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

        $fqcn = $this->classFQCNBuilder->buildFQCN($namespace, $interfaceName);

        $attribute = $this->attributeFinder->findConnectAnnotation($fqcn);

        if ($attribute === null) {
            return null;
        }

        return new FoundAnnotation($fqcn->toString(), $attribute->getImplementation()->toString());
    }
}
