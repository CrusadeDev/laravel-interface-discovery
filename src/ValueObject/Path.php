<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ValueObject;

final class Path
{
    public function __construct(private string $path)
    {
    }

    public function toString(): string
    {
        return $this->path;
    }
}
