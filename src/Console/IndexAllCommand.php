<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Console;

use Crusade\LaravelInterface\Service\AnnotationService;
use Crusade\LaravelInterface\Service\FileService;
use Crusade\LaravelInterface\ValueObject\File;
use Crusade\LaravelInterface\ValueObject\Path;
use Illuminate\Console\Command;

final class IndexAllCommand extends Command
{
    protected $signature = 'discover:interfaces:all {--source} {--resultPath}';
    protected $description = 'Index all interface and generate config';
    private AnnotationService $annotationService;
    private FileService $fileService;

    public function __construct()
    {
        parent::__construct();
        $this->annotationService = new AnnotationService();
        $this->fileService = new FileService();
    }

    public function handle(): void
    {
        $path = $this->argument('source');
        $resultPath = $this->argument('resultPath');

        $files = $this->fileService->findFileInPath(new Path($path));
        $files
            ->transform(function (File $file): ?array {
                return $this->annotationService->handle($file);
            })
            ->filter(fn(?array $files) => $files !== null)
            ->reduce(function (array $carry, array $item): array {
                return array_merge($carry, $item);
            });

        $this->fileService->saveToFile(new Path($resultPath), $files);
    }
}