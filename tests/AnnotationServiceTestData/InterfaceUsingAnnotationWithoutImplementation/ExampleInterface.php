<?php

/** @noinspection PhpParamsInspection */

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests\AnnotationServiceTestData\InterfaceUsingAnnotationWithoutImplementation;

use Crusade\LaravelInterface\Annotation\ConnectAnnotation;

#[ConnectAnnotation()]
interface ExampleInterface
{

}
