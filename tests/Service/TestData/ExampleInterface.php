<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests\Service\TestData;
use Crusade\LaravelInterface\Annotation\ConnectAnnotation;

#[ConnectAnnotation(ExampleImplementation::class)]
interface ExampleInterface
{

}
