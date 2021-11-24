<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Service;

use Crusade\LaravelInterface\ArrayList;
use Crusade\LaravelInterface\FileFinder;
use Crusade\LaravelInterface\FileSaver;
use Crusade\LaravelInterface\PhpFileArrayBuilder;
use Crusade\LaravelInterface\ValueObject\FileContent;
use Crusade\LaravelInterface\ValueObject\Path;

final class FileService
{
    public function __construct(
        private FileSaver $fileSaver,
        private FileFinder $fileFinder,
        private PhpFileArrayBuilder $contentBuilder
    ) {
    }

    /**
     * @param Path $path
     * @param ArrayList<string, string> $content
     */
    public function saveToFile(Path $path, ArrayList $content): void
    {
        $contentAsString = $this->contentBuilder->build($content);

        $this->fileSaver->saveToFile($path, $contentAsString);
    }

    /**
     * @return ArrayList<int, FileContent>
     */
    public function findFileInPath(Path $path): ArrayList
    {
        return $this->fileFinder->find($path);
    }
}
