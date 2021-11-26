<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Shared\Repository;

use Crusade\LaravelInterface\Infrastructure\ArrayList;
use Crusade\LaravelInterface\Shared\ValueObject\FileContent;
use Crusade\LaravelInterface\Shared\ValueObject\Path;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

final class FileRepository implements FileRepositoryInterface
{
    public function __construct(private Filesystem $filesystem, private Finder $finder)
    {
    }

    public function dumpToFile(Path $path, FileContent $content): void
    {
        $this->filesystem->dumpFile($path->toString(), $content->getContent());
    }

    /**
     * @inheritDoc
     */
    public function findPhpFilesContent(Path $path): ArrayList
    {
        $this->finder->files()->in($path->toString())->name('*.php');

        if ($this->finder->hasResults() === false) {
            return new ArrayList();
        }

        $result = [];

        foreach ($this->finder as $file) {
            $result[] = new FileContent($file->getContents());
        }

        return new ArrayList($result);
    }
}
