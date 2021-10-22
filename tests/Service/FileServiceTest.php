<?php

namespace Crusade\LaravelInterface\Tests\Service;

use Crusade\LaravelInterface\ArrayList;
use Crusade\LaravelInterface\Service\FileService;
use Crusade\LaravelInterface\ValueObject\FullQualifiedClassNameVo;
use Crusade\LaravelInterface\ValueObject\Path;
use PHPUnit\Framework\TestCase;

final class FileServiceTest extends TestCase
{
    private FileService $service;
    private Path $path;

    public function test_SaveToFile_ShouldCreateFileIfNotExists(): void
    {
        $this->path = new Path(__DIR__.'/test.php');
        $this->service->saveToFile($this->path, ArrayList::empty());

        self::assertFileExists($this->path->toString());
    }

    public function test_SaveToFile_SaveGivenContentToFile(): void
    {
        $this->path = new Path(__DIR__.'/test.php');
        $this->service->saveToFile(
            $this->path,
            new ArrayList(['test' => new FullQualifiedClassNameVo(__CLASS__)])
        );

        self::assertFileEquals(__DIR__.'/FileServiceExpectedFile.php', __DIR__.'/test.php');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unlink($this->path->toString());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FileService();
    }
}
