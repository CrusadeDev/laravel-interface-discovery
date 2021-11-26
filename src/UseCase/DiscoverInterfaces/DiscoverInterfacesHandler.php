<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\UseCase\DiscoverInterfaces;

use Crusade\LaravelInterface\Infrastructure\ArrayList;
use Crusade\LaravelInterface\Shared\Exception\AttributeDoesNotContainsRequiredArgumentsException;
use Crusade\LaravelInterface\Shared\Exception\ClassOrInterfaceDoesNotExistException;
use Crusade\LaravelInterface\Shared\Exception\ImplementationMustBeAClassException;
use Crusade\LaravelInterface\Shared\Exception\InterfaceImplementsMultipleConnectionAnnotationException;
use Crusade\LaravelInterface\Shared\Repository\FileRepositoryInterface;
use Crusade\LaravelInterface\Shared\ValueObject\FileContent;
use Crusade\LaravelInterface\Shared\ValueObject\FoundAnnotation;
use Crusade\LaravelInterface\Shared\ValueObject\Path;
use Crusade\LaravelInterface\UseCase\DiscoverInterfaces\Builder\ArrayListConverter;

final class DiscoverInterfacesHandler
{
    public function __construct(
        private AnnotationService $annotationService,
        private ArrayListConverter $contentBuilder,
        private FileRepositoryInterface $fileRepository
    ) {
    }

    /**
     * @throws AttributeDoesNotContainsRequiredArgumentsException
     * @throws ClassOrInterfaceDoesNotExistException
     * @throws ImplementationMustBeAClassException
     * @throws InterfaceImplementsMultipleConnectionAnnotationException
     * @noinspection PhpDocRedundantThrowsInspection // phpstorm does not see exceptions in closers
     */
    public function handle(Path $src, Path $cachePath): void
    {
        $files = $this->fileRepository->findPhpFilesContent($src);

        $files = $files
            ->transform(
                fn(FileContent $file): FoundAnnotation => $this->annotationService->findConnectAnnotation($file)
            )
            ->filter(fn(?FoundAnnotation $files) => $files !== null)
            ->reduce(fn(?array $carry, FoundAnnotation $item): ArrayList => $this->reduceIntoFlatArray($carry, $item));

        $fileContent = $this->contentBuilder->build($files);

        $this->fileRepository->dumpToFile($cachePath, $fileContent);
    }

    /**
     * @param array<int,FoundAnnotation>|null $carry
     * @return ArrayList<int,FoundAnnotation>
     */
    private function reduceIntoFlatArray(?array $carry, FoundAnnotation $item): ArrayList
    {
        if ($carry === null) {
            $carry = [];
        }

        return ArrayList::wrap(array_merge($carry, $item));
    }
}
