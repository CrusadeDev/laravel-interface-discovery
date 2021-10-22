<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Service;

use Crusade\LaravelInterface\ArrayList;
use Crusade\LaravelInterface\ValueObject\File;
use Crusade\LaravelInterface\ValueObject\Path;

final class MainService
{
    private AnnotationService $annotationService;
    private FileService $fileService;

    public function __construct()
    {
        $this->annotationService = new AnnotationService();
        $this->fileService = new FileService();
    }

    public function discover(Path $src, Path $cachePath): void
    {
        $files = $this->fileService->findFileInPath($src);
        $files = $files
            ->transform(fn(File $file): ?array => $this->annotationService->handle($file))
            ->filter(fn(?array $files) => $files !== null)
            ->reduce(function (?array $carry, array $item): ArrayList {
                if ($carry === null) {
                    $carry = [];
                }

                return ArrayList::wrap(array_merge($carry, $item));
            });


        $this->fileService->saveToFile($cachePath, $files);
    }
}
