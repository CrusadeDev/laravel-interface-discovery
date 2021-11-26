<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Shared\Port;

use Crusade\LaravelInterface\Shared\ValueObject\Path;

interface ConfigPathInterface
{
    public function getConfigPath(): Path;
}
