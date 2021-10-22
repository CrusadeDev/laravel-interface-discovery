<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Port;

use Crusade\LaravelInterface\ValueObject\Path;

final class ConfigLaravelPath implements ConfigPathInterface
{
    public function getConfigPath(): Path
    {
        return new Path(config());
    }
}