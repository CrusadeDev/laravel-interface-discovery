<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace Crusade\LaravelInterface\Annotation;

use Attribute;
use Crusade\LaravelInterface\ValueObject\FullQualifiedClassNameVo;

#[Attribute]
class ConnectAnnotation implements AnnotationInterface
{
    public function __construct(private string $implementation)
    {
    }

    public function getImplementation(): FullQualifiedClassNameVo
    {
        return new FullQualifiedClassNameVo($this->implementation);
    }
}
