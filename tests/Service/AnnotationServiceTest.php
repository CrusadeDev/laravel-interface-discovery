<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests\Service;

use Crusade\LaravelInterface\Service\AnnotationService;
use Crusade\LaravelInterface\Tests\TestData\AstData;
use Crusade\LaravelInterface\Tests\TestData\FileWithAnnotation;
use Crusade\LaravelInterface\Tests\TestData\FileWithClass;
use PHPUnit\Framework\TestCase;

final class AnnotationServiceTest extends TestCase
{
    private AnnotationService $service;
    private AstData $testData;

    public function test_handle_ShouldReturnNullWhenFileDoesNotContainInterface(): void
    {
        $result = $this->service->handle($this->testData->getFileWithClass());

        self::assertNull($result);
    }

    public function test_handle_ShouldReturnNullWhenFileDoesNotHaveNamespace(): void
    {
        $result = $this->service->handle($this->testData->getFileWithoutNamespace());

        self::assertNull($result);
    }

    public function test_handle_ShouldReturnNullWhenFileHaveInterfaceWithoutAnnotation(): void
    {
        $result = $this->service->handle($this->testData->getFileWithNamespaceAndInterface());

        self::assertNull($result);
    }

    public function test_handle_ShouldReturnArrayWithInterfaceNameAsKeyAndImplementationAsValue(): void
    {
        $result = $this->service->handle($this->testData->getFileWithAnnotation());

        self::assertIsArray($result);
        self::assertArrayHasKey(FileWithAnnotation::class, $result);
        self::assertEquals(FileWithClass::class, $result[FileWithAnnotation::class]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new AnnotationService();
        $this->testData = new AstData();
    }
}
