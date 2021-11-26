<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Shared\Repository;

use Crusade\LaravelInterface\Infrastructure\ArrayList;
use Crusade\LaravelInterface\Shared\ValueObject\FileContent;
use Crusade\LaravelInterface\Shared\ValueObject\Path;

interface FileRepositoryInterface
{
    public function dumpToFile(Path $path, FileContent $content): void;

    /**
     * @return \Crusade\LaravelInterface\Infrastructure\ArrayList<int, FileContent>
     */
    public function findPhpFilesContent(Path $path): ArrayList;
}
