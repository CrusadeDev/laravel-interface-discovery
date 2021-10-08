<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests\TestData;

use Crusade\LaravelInterface\FileParser;
use Crusade\LaravelInterface\ValueObject\AstRepresentation;
use Crusade\LaravelInterface\ValueObject\File;
use Symfony\Component\Finder\SplFileInfo;

class AstData
{
    private FileParser $parser;

    public function __construct()
    {
        $this->parser = new FileParser();
    }

    public function getAstWithInterface(): AstRepresentation
    {
        return $this->parser->parse($this->getFileWithNamespaceAndInterface());
    }

    public function getFileWithNamespaceAndInterface(): File
    {
        return new File(
            new SplFileInfo(
                '/var/www/html/tests/TestData/FileWithInterface.php',
                '',
                'FileWithInterface.php'
            )
        );
    }

    public function getAstWithoutNamespace(): AstRepresentation
    {
        return $this->parser->parse($this->getFileWithoutNamespace());
    }

    public function getFileWithoutNamespace(): File
    {
        return new File(
            new SplFileInfo(
                '/var/www/html/tests/TestData/FileWithoutNamespace.php',
                '',
                'FileWithoutNamespace.php'
            )
        );
    }

    public function getAstWithoutInterface(): AstRepresentation
    {
        return $this->parser->parse($this->getFileWithoutInterface());
    }

    public function getFileWithoutInterface(): File
    {
        return new File(
            new SplFileInfo(
                '/var/www/html/tests/TestData/FileWithoutInterface.php',
                '',
                'FileWithoutInterface.php'
            )
        );
    }

    public function getFileWithAnnotation(): File
    {
        return new File(
            new SplFileInfo(
                '/var/www/html/tests/TestData/FileWithAnnotation',
                '',
                'FileWithoutInterface.php'
            )
        );
    }

    public function getAstWithAnnotation(): AstRepresentation
    {
        return $this->parser->parse($this->getFileWithAnnotation());
    }
}
