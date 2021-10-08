<?php

namespace Crusade\LaravelInterface\Tests;

use Crusade\LaravelInterface\FileParser;
use Crusade\LaravelInterface\ValueObject\File;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\SplFileInfo;

class FileParserTest extends TestCase
{
    private FileParser $parser;
    private File $file;

    public function test_parse(): void
    {
        $result = $this->parser->parse($this->file);

        self::assertCount(2, $result->getStmt());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->parser = new FileParser();
        $this->file = new File(
            new SplFileInfo(
                '/var/www/html/tests/TestData/FileWithInterface.php',
                '',
                'FileWithInterface.php'
            )
        );
    }
}
