<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Console;

use Crusade\LaravelInterface\Shared\Port\ConfigPathInterface;
use Crusade\LaravelInterface\Shared\ValueObject\Path;
use Crusade\LaravelInterface\UseCase\DiscoverInterfaces\DiscoverInterfacesHandler;
use Illuminate\Console\Command;

final class IndexAllCommand extends Command
{
    protected $signature = 'discover:interfaces:all {source}';
    protected $description = 'Index all interface and generate config';

    public function __construct(private DiscoverInterfacesHandler $service, private ConfigPathInterface $configPath)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $path = $this->argument('source');

        try {
            $this->service->handle(
                new Path($path),
                new Path($this->configPath->getConfigPath()->toString().'/generated_config.php')
            );
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
