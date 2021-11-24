<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface;

use Crusade\LaravelInterface\ValueObject\FileContent;
use Crusade\LaravelInterface\ValueObject\Path;
use Symfony\Component\Finder\Finder;

final class FileFinder
{
    public function __construct(private Finder $finder)
    {
    }

    /**
     * @return ArrayList<int, FileContent>
     */
    public function find(Path $path): ArrayList
    {
        $this->finder->files()->in($path->toString())->name('*.php');

        if ($this->finder->hasResults() === false) {
            return new ArrayList();
        }

        $result = [];

        foreach ($this->finder as $file) {
            $result[] = new FileContent($file);
        }

        return new ArrayList($result);
    }
}
