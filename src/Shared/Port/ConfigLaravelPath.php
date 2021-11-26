<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Shared\Port;

use Crusade\LaravelInterface\Shared\ValueObject\Path;

final class ConfigLaravelPath implements ConfigPathInterface
{
    public function getConfigPath(): Path
    {
        return new Path(config_path());
    }
}
