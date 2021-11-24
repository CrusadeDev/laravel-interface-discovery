<?php

/** @noinspection PhpUndefinedClassInspection */

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests\AnnotationServiceTestData\InterfaceWithAnnotationWithNonExistingImplementation;

use Crusade\LaravelInterface\Annotation\ConnectAnnotation;

#[ConnectAnnotation(ExampleImplementation::class)]
interface ExampleInterface
{

}
