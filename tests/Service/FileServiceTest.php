<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests\Service;

use Crusade\LaravelInterface\Shared\Repository\FileRepository;
use Crusade\LaravelInterface\Shared\ValueObject\Path;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

final class FileServiceTest extends TestCase
{
    private FileRepository $service;

    public function test_FindFileInPath_ShouldFindSingleFile_WhenFolderContainsOnlyOne(): void
    {
        $path = new Path(__DIR__.'/TestData/SinglePhpFile');
        $result = $this->service->findPhpFilesContent($path);

        self::assertCount(1, $result->toArray());
    }

    public function test_FindFileInPath_ShouldNotFind_WhenFolderDoesNotContainsPhpFiles(): void
    {
        $path = new Path(__DIR__.'/TestData/NonPhpFiles');
        $result = $this->service->findPhpFilesContent($path);

        self::assertCount(0, $result->toArray());
    }

    public function test_FindFileInPath_ShouldFindPhpFile_WhenIsInSubDirectory(): void
    {
        $path = new Path(__DIR__.'/TestData/FileInSubDirectory');
        $result = $this->service->findPhpFilesContent($path);

        self::assertCount(1, $result->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FileRepository(new Filesystem(), new Finder());
    }
}
