<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface;

use Crusade\LaravelInterface\ValueObject\Content;
use Crusade\LaravelInterface\ValueObject\Path;
use Symfony\Component\Filesystem\Filesystem;

class FileSaver
{
    private Filesystem $fileSystem;

    public function __construct()
    {
        $this->fileSystem = new Filesystem();
    }

    public function saveToFile(Path $path, Content $content): void
    {
        $this->fileSystem->dumpFile($path->toString(), $content->toString());
    }
}
