<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests\AnnotationServiceTestData\InterfaceUsingAnnotationWithInterfaceAsImplementation;

use Crusade\LaravelInterface\Annotation\ConnectAnnotation;

#[ConnectAnnotation(ExampleImplementationAsInterface::class)]
interface ExampleInterface
{

}
