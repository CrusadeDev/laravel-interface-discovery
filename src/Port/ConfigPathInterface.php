<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Port;

use Crusade\LaravelInterface\ValueObject\Path;

interface ConfigPathInterface
{
    public function getConfigPath(): Path;
}
