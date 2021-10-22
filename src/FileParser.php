<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface;

use Crusade\LaravelInterface\ValueObject\AstRepresentation;
use Crusade\LaravelInterface\ValueObject\File;
use PhpParser\Parser;
use PhpParser\ParserFactory;

final class FileParser
{
    private Parser $parser;

    public function __construct()
    {
        $this->parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    }

    public function parse(File $file): AstRepresentation
    {
        $ast = $this->parser->parse($file->getContent());

        if ($ast === null) {
            return new AstRepresentation([]);
        }

        return new AstRepresentation($ast);
    }
}
