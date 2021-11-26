<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\UseCase\DiscoverInterfaces;

use Crusade\LaravelInterface\Shared\Exception\AttributeDoesNotContainsRequiredArgumentsException;
use Crusade\LaravelInterface\Shared\Exception\ClassOrInterfaceDoesNotExistException;
use Crusade\LaravelInterface\Shared\Exception\ImplementationMustBeAClassException;
use Crusade\LaravelInterface\Shared\Exception\InterfaceImplementsMultipleConnectionAnnotationException;
use Crusade\LaravelInterface\Shared\ValueObject\FileContent;
use Crusade\LaravelInterface\Shared\ValueObject\FoundAnnotation;

final class AnnotationService
{
    public function __construct(
        private FullQualifiedClassNameExtractor $extractor,
        private ConnectAnnotationFinder $attributeFinder,
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
        $fqcn = $this->extractor->extractNamespaceFromAst($file);

        if ($fqcn === null) {
            return null;
        }

        $attribute = $this->attributeFinder->findConnectAnnotation($fqcn);

        if ($attribute === null) {
            return null;
        }

        return new FoundAnnotation($fqcn->toString(), $attribute->getImplementation()->toString());
    }
}
