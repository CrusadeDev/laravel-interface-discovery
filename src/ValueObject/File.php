<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ValueObject;

use Symfony\Component\Finder\SplFileInfo;

class File
{
    public function __construct(private SplFileInfo $file)
    {
    }

    public function getContent(): string
    {
        return $this->file->getContents();
    }
}
