<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Service;

use Crusade\LaravelInterface\FileFinder;

class AnnotationService
{
    public function __construct()
    {
        $this->fileFinder = new FileFinder();
    }
}