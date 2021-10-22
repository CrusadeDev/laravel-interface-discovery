<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Console;

use Crusade\LaravelInterface\Service\MainService;
use Crusade\LaravelInterface\ValueObject\Path;
use Illuminate\Console\Command;

final class IndexAllCommand extends Command
{
    protected $signature = 'discover:interfaces:all {source} {resultPath}';
    protected $description = 'Index all interface and generate config';

    public function __construct(private MainService $service)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $path = $this->argument('source');
        $resultPath = $this->argument('resultPath');

        $this->service->discover(new Path($path), new Path($resultPath));
    }
}
