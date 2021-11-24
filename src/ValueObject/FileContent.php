<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ValueObject;

final class FileContent
{
    public function __construct(private string $fileContent)
    {
    }

    public function getContent(): string
    {
        return $this->fileContent;
    }
}
