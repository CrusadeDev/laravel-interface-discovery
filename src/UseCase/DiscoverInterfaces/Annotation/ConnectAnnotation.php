<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */

declare(strict_types=1);

namespace Crusade\LaravelInterface\UseCase\DiscoverInterfaces\Annotation;

use Attribute;
use Crusade\LaravelInterface\Shared\Exception\ClassOrInterfaceDoesNotExistException;
use Crusade\LaravelInterface\Shared\ValueObject\FullQualifiedClassNameVo;

#[Attribute]
final class ConnectAnnotation implements AnnotationInterface
{
    public function __construct(private string $implementation)
    {
    }

    /**
     * @throws ClassOrInterfaceDoesNotExistException
     */
    public function getImplementation(): FullQualifiedClassNameVo
    {
        return new FullQualifiedClassNameVo($this->implementation);
    }
}
