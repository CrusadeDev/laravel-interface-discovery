<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests;

use Crusade\LaravelInterface\FileFinder;
use PHPUnit\Framework\TestCase;

class FileFinderTest extends TestCase
{
    private FileFinder $finder;

    public function test_find_shouldReturnFilesInPath(): void
    {
        $files = $this->finder->find('/var/www/html/tests/TestData/FinderTestFolder');

        self::assertCount(1, $files->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->finder = new FileFinder();
    }
}
