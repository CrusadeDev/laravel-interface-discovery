<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests\AnnotationServiceTestData\InterfaceWithMultipleConnectAnnotation;

use Crusade\LaravelInterface\Annotation\ConnectAnnotation;

#[ConnectAnnotation(ExampleImplementation::class)]
#[ConnectAnnotation(ExampleImplementation::class)]
interface ExampleInterface
{

}
