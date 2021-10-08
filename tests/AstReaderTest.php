<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests;

use Crusade\LaravelInterface\AstReader;
use Crusade\LaravelInterface\Tests\TestData\AstData;
use LogicException;
use PHPUnit\Framework\TestCase;

class AstReaderTest extends TestCase
{
    private AstReader $reader;
    private AstData $astData;

    public function test_findNamespace_ShouldReturnNamespace(): void
    {
        $result = $this->reader->findNamespace($this->astData->getAstWithInterface());

        self::assertEquals('Crusade\LaravelInterface\Tests\TestData', $result->getNamespaceName());
    }

    public function test_findNamespace_ShouldThrowException_WhenNotPresented(): void
    {
        $this->expectException(LogicException::class);

        $this->reader->findInterface($this->astData->getAstWithoutNamespace());
    }

    public function test_findInterface_ShouldThrowException(): void
    {
        $this->expectException(LogicException::class);

        $this->reader->findInterface($this->astData->getAstWithoutInterface());
    }

    public function test_findInterface_ShouldReturnInterface(): void
    {
        $result = $this->reader->findInterface($this->astData->getAstWithInterface());

        self::assertEquals('FileWithInterface', $result->getInterfaceName());
    }

    public function test_findClass_ShouldReturnClass(): void
    {
        $result = $this->reader->findClass($this->astData->getAstWithClass());

        self::assertEquals('FileWithClass', $result->getClassName());
    }

    public function test_findClass_ShouldThrowException(): void
    {
        $this->expectException(LogicException::class);

        $this->reader->findClass($this->astData->getAstWithInterface());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->reader = new AstReader();
        $this->astData = new AstData();
    }
}
