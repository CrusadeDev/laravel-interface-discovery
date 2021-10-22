<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ValueObject;

final class Content
{
    public function __construct(private string $content)
    {
    }

    public function toString(): string
    {
        return $this->content;
    }
}