<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Console;

use Crusade\LaravelInterface\Port\ConfigPathInterface;
use Crusade\LaravelInterface\Service\MainService;
use Crusade\LaravelInterface\ValueObject\Path;
use Illuminate\Console\Command;

final class IndexAllCommand extends Command
{
    protected $signature = 'discover:interfaces:all {source}';
    protected $description = 'Index all interface and generate config';

    public function __construct(private MainService $service, private ConfigPathInterface $configPath)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $path = $this->argument('source');

        try {
            $this->service->discover(
                new Path($path),
                new Path($this->configPath->getConfigPath()->toString().'/generated_config.php')
            );
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
