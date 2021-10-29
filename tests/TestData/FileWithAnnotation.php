<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests\TestData;

use Crusade\LaravelInterface\Annotation\ConnectAnnotation;

#[ConnectAnnotation(FileWithClass::class)]
interface FileWithAnnotation
{

}
