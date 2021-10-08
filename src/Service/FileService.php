<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Service;

use Crusade\LaravelInterface\FileSaver;
use Crusade\LaravelInterface\PhpFileArrayBuilder;
use Crusade\LaravelInterface\ValueObject\Path;

class FileService
{
    private FileSaver $fileSaver;
    private PhpFileArrayBuilder $contentBuilder;

    public function __construct()
    {
        $this->fileSaver = new FileSaver();
        $this->contentBuilder = new PhpFileArrayBuilder();
    }

    public function saveToFile(Path $path, array $content): void
    {
        $contentAsString = $this->contentBuilder->build($content);

        $this->fileSaver->saveToFile($path, $contentAsString);
    }
}