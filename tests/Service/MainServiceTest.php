<?php

namespace Crusade\LaravelInterface\Tests\Service;

use Crusade\LaravelInterface\Service\MainService;
use Crusade\LaravelInterface\ValueObject\Path;
use PHPUnit\Framework\TestCase;

final class MainServiceTest extends TestCase
{
    private MainService $service;
    private Path $resultPath;

    public function test_discover_shouldSaveToFileResult(): void
    {
        $this->resultPath = new Path(__DIR__.'/TestData/test.php');
        $this->service->discover(new Path(__DIR__.'/TestData'), $this->resultPath);

        self::assertFileExists($this->resultPath->toString());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unlink($this->resultPath->toString());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new MainService();
    }
}
