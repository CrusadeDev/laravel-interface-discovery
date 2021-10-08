<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface;

use Crusade\LaravelInterface\ValueObject\File;
use Symfony\Component\Finder\Finder;

class FileFinder
{
    private Finder $finder;

    public function __construct()
    {
        $this->finder = new Finder();
    }

    /**
     * @return ArrayList<int, File>
     */
    public function find(string $path): ArrayList
    {
        $this->finder->files()->in($path)->name('*.php');

        if ($this->finder->hasResults() === false) {
            return new ArrayList();
        }

        $result = [];

        foreach ($this->finder as $file) {
            $result[] = new File($file);
        }

        return new ArrayList($result);
    }
}
