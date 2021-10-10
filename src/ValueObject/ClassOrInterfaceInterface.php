<?php

namespace Crusade\LaravelInterface\ValueObject;

interface ClassOrInterfaceInterface
{
    /**
     * @return class-string
     */
    public function toString(): string;
}