<?php

/** @noinspection PhpParamsInspection */

declare(strict_types=1);

namespace Crusade\LaravelInterface\UseCase\DiscoverInterfaces\tests\AnnotationServiceTestData\InterfaceUsingAnnotationWithoutImplementation;

use Crusade\LaravelInterface\UseCase\DiscoverInterfaces\Annotation\ConnectAnnotation;

#[ConnectAnnotation()]
interface ExampleInterface
{

}
