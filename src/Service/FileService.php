<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Service;

use Crusade\LaravelInterface\ArrayList;
use Crusade\LaravelInterface\FileFinder;
use Crusade\LaravelInterface\FileSaver;
use Crusade\LaravelInterface\PhpFileArrayBuilder;
use Crusade\LaravelInterface\ValueObject\File;
use Crusade\LaravelInterface\ValueObject\Path;

final class FileService
{
    private FileSaver $fileSaver;
    private FileFinder $fileFinder;
    private PhpFileArrayBuilder $contentBuilder;

    public function __construct()
    {
        $this->fileSaver = new FileSaver();
        $this->fileFinder = new FileFinder();
        $this->contentBuilder = new PhpFileArrayBuilder();
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
     * @return ArrayList<int, File>
     */
    public function findFileInPath(Path $path): ArrayList
    {
        return $this->fileFinder->find($path);
    }
}