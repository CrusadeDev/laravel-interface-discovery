<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests;

use Crusade\LaravelInterface\AstReader;
use Crusade\LaravelInterface\Tests\TestData\AstData;
use PHPUnit\Framework\TestCase;

final class AstReaderTest extends TestCase
{
    private AstReader $reader;
    private AstData $astData;

    public function test_findNamespace_ShouldReturnNamespace(): void
    {
        $result = $this->reader->findNamespace($this->astData->getAstWithInterface());

        self::assertEquals('Crusade\LaravelInterface\Tests\TestData', $result->getNamespaceName());
    }

    public function test_findNamespace_ShouldReturnNull_WhenNotPresented(): void
    {
        $result = $this->reader->findInterface($this->astData->getAstWithoutNamespace());

        self::assertNull($result);
    }

    public function test_findInterface_ShouldReturnNull(): void
    {
        $result = $this->reader->findInterface($this->astData->getAstWithoutInterface());

        self::assertNull($result);
    }

    public function test_findInterface_ShouldReturnInterface(): void
    {
        $result = $this->reader->findInterface($this->astData->getAstWithInterface());

        self::assertEquals('FileWithInterface', $result->toString());
    }

    public function test_findClass_ShouldReturnClass(): void
    {
        $result = $this->reader->findClass($this->astData->getAstWithClass());

        self::assertEquals('FileWithClass', $result->toString());
    }

    public function test_findClass_ShouldReturnNull_WhenIsNotPresent(): void
    {
        $result = $this->reader->findClass($this->astData->getAstWithInterface());

        self::assertNull($result);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->reader = new AstReader();
        $this->astData = new AstData();
    }
}
