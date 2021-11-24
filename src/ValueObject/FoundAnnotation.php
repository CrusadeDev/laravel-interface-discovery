<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ValueObject;

final class FoundAnnotation
{
    public function __construct(private string $interaceFQCN, private string $implementationFQCN)
    {
    }

    public function getInterfaceFQCN(): string
    {
        return $this->interaceFQCN;
    }

    public function getImplementationFQCN(): string
    {
        return $this->implementationFQCN;
    }
}
