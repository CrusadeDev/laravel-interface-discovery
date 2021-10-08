<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests;

use Crusade\LaravelInterface\ArrayList;
use Crusade\LaravelInterface\PhpFileArrayBuilder;
use Crusade\LaravelInterface\Tests\TestData\FileWithAnnotation;
use Crusade\LaravelInterface\Tests\TestData\FileWithClass;
use Crusade\LaravelInterface\ValueObject\FullQualifiedClassNameVo;
use PHPUnit\Framework\TestCase;

class PhpFileArrayBuilderTest extends TestCase
{
    private PhpFileArrayBuilder $builder;

    public function test_build_shouldConvertArrayToPhpFileArray_whenArrayIsEmpty(): void
    {
        $result = $this->builder->build(ArrayList::empty());

        self::assertEquals('<?php return [];', $result->toString());
    }

    public function test_build_shouldConvertArrayToPhpFileArray_whenArrayContainsElements(): void
    {
        $result = $this->builder->build(
            ArrayList::wrap([FileWithAnnotation::class => new FullQualifiedClassNameVo(FileWithClass::class)])
        );

        self::assertEquals("<?php return ['test' => 'test',];", $result->toString());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = new PhpFileArrayBuilder();
    }
}