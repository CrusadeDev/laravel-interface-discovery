<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Service;

use Crusade\LaravelInterface\ArrayList;
use Crusade\LaravelInterface\Exception\AttributeDoesNotContainsRequiredArgumentsException;
use Crusade\LaravelInterface\Exception\ClassOrInterfaceDoesNotExistException;
use Crusade\LaravelInterface\Exception\ImplementationMustBeAClassException;
use Crusade\LaravelInterface\Exception\InterfaceImplementsMultipleConnectionAnnotationException;
use Crusade\LaravelInterface\ValueObject\FileContent;
use Crusade\LaravelInterface\ValueObject\FoundAnnotation;
use Crusade\LaravelInterface\ValueObject\Path;

final class MainService
{
    public function __construct(private AnnotationService $annotationService, private FileService $fileService)
    {
    }

    /**
     * @throws AttributeDoesNotContainsRequiredArgumentsException
     * @throws ClassOrInterfaceDoesNotExistException
     * @throws ImplementationMustBeAClassException
     * @throws InterfaceImplementsMultipleConnectionAnnotationException
     * @noinspection PhpDocRedundantThrowsInspection // phpstorm does not see exceptions in closers
     */
    public function discover(Path $src, Path $cachePath): void
    {
        $files = $this->fileService->findFileInPath($src);

        $files = $files
            ->transform(fn(FileContent $file): ?FoundAnnotation => $this->annotationService->findConnectAnnotation($file))
            ->filter(fn(?FoundAnnotation $files) => $files !== null)
            ->reduce(fn(?array $carry, FoundAnnotation $item): ArrayList => $this->reduceIntoFlatArray($carry, $item));

        $this->fileService->saveToFile($cachePath, $files);
    }

    private function reduceIntoFlatArray(?array $carry, FoundAnnotation $item): ArrayList
    {
        if ($carry === null) {
            $carry = [];
        }

        return ArrayList::wrap(array_merge($carry, $item));
    }
}
