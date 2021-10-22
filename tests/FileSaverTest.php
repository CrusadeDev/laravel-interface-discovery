<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests;

use Crusade\LaravelInterface\FileSaver;
use Crusade\LaravelInterface\ValueObject\Content;
use Crusade\LaravelInterface\ValueObject\Path;
use PHPUnit\Framework\TestCase;

final class FileSaverTest extends TestCase
{
    private FileSaver $fileSaver;
    private Path $createdFile;

    public function test_saveToFile_ShouldSaveToFile(): void
    {
        $this->fileSaver->saveToFile($this->createdFile, new Content('<?php return [];'));

        self::assertFileExists($this->createdFile->toString());
    }

    public function test_saveToFile_ShouldContainGivenContent(): void
    {
        $this->fileSaver->saveToFile($this->createdFile, new Content('<?php return [];'));

        self::assertFileEquals(
            (new Path(__DIR__.'/FileSaverExpectedFile.php'))->toString(),
            $this->createdFile->toString()
        );
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->fileSaver = new FileSaver();
        $this->createdFile = new Path(__DIR__.'/test.php');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unlink($this->createdFile->toString());
    }
}