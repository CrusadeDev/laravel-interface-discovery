<?php

namespace Crusade\LaravelInterface\Shared\ValueObject;

interface ClassOrInterfaceInterface
{
    /**
     * @return class-string
     */
    public function toString(): string;
}
