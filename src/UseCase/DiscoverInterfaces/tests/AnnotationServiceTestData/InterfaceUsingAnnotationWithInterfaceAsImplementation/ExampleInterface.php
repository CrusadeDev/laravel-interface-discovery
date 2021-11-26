<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\UseCase\DiscoverInterfaces\tests\AnnotationServiceTestData\InterfaceUsingAnnotationWithInterfaceAsImplementation;

use Crusade\LaravelInterface\UseCase\DiscoverInterfaces\Annotation\ConnectAnnotation;

#[ConnectAnnotation(ExampleImplementationAsInterface::class)]
interface ExampleInterface
{

}
