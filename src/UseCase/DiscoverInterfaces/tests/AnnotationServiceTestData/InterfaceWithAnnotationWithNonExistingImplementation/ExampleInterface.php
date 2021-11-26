<?php

/** @noinspection PhpUndefinedClassInspection */

declare(strict_types=1);

namespace Crusade\LaravelInterface\UseCase\DiscoverInterfaces\tests\AnnotationServiceTestData\InterfaceWithAnnotationWithNonExistingImplementation;

use Crusade\LaravelInterface\UseCase\DiscoverInterfaces\Annotation\ConnectAnnotation;

#[ConnectAnnotation(ExampleImplementation::class)]
interface ExampleInterface
{

}
