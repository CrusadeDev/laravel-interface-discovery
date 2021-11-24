<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests;

use Crusade\LaravelInterface\AstReader;
use Crusade\LaravelInterface\ConnectAnnotationFinder;
use Crusade\LaravelInterface\ClassFQCNBuilder;
use Crusade\LaravelInterface\Exception\AttributeDoesNotContainsRequiredArgumentsException;
use Crusade\LaravelInterface\Exception\ClassOrInterfaceDoesNotExistException;
use Crusade\LaravelInterface\Exception\ImplementationMustBeAClassException;
use Crusade\LaravelInterface\Exception\InterfaceImplementsMultipleConnectionAnnotationException;
use Crusade\LaravelInterface\FileParser;
use Crusade\LaravelInterface\Service\AnnotationService;
use Crusade\LaravelInterface\Tests\AnnotationServiceTestData\InterfaceAndImplementationUsingAnnotation\ExampleImplementation;
use Crusade\LaravelInterface\Tests\AnnotationServiceTestData\InterfaceAndImplementationUsingAnnotation\ExampleInterface;
use PhpParser\NodeTraverser;
use PHPUnit\Framework\TestCase;

final class AnnotationServiceTest extends TestCase
{
    private AnnotationService $service;
    private AnnotationServiceTestData $testData;

    public function test_handle_ShouldReturnAnnotationWhenInterfaceUseAnnotation(): void
    {
        $result = $this->service->findConnectAnnotation(
            $this->testData->getInterfaceUsingAnnotationWithImplementation()
        );

        self::assertNotNull($result);
        self::assertEquals(ExampleInterface::class, $result->getInterfaceFQCN());
        self::assertEquals(ExampleImplementation::class, $result->getImplementationFQCN());
    }

    public function test_handle_ShouldReturnNullWhenInterfaceDoesNotUseAnnotation(): void
    {
        $result = $this->service->findConnectAnnotation(
            $this->testData->getInterfaceNotUsingAnnotation()
        );

        self::assertNull($result);
    }

    public function test_handle_ShouldReturnNullWhenClassGiven(): void
    {
        $result = $this->service->findConnectAnnotation(
            $this->testData->getImplementation()
        );

        self::assertNull($result);
    }

    public function test_handle_ShouldReturnNullWhenInterfaceDoesNotContainNamespace(): void
    {
        $result = $this->service->findConnectAnnotation(
            $this->testData->getInterfaceWithoutNamespace()
        );

        self::assertNull($result);
    }

    public function test_handle_ShouldThrowExceptionWhenInterfaceUseAnnotationWithNonExistingImplementation(): void
    {
        $this->expectException(ClassOrInterfaceDoesNotExistException::class);

        $this->service->findConnectAnnotation(
            $this->testData->getInterfaceUsingAnnotationWithoutExistingImplementation()
        );
    }

    public function test_handle_ShouldThrowExceptionWhenInterfaceUseAnnotationWithInterfaceAsImplementation(): void
    {
        $this->expectException(ImplementationMustBeAClassException::class);

        $this->service->findConnectAnnotation(
            $this->testData->getInterfaceUsingAnnotationWithInterfaceAsImplementation()
        );
    }

    public function test_handle_ShouldThrowExceptionWhenInterfaceIsUsingAnnotationWithoutImplementation(): void
    {
        $this->expectException(AttributeDoesNotContainsRequiredArgumentsException::class);

        $this->service->findConnectAnnotation(
            $this->testData->getInterfaceUsingAnnotationWithoutImplementation()
        );
    }

    public function test_handle_ShouldThrowExceptionWhenInterfaceImplementsMultipleConnectionAnnotation(): void
    {
        $this->expectException(InterfaceImplementsMultipleConnectionAnnotationException::class);

        $this->service->findConnectAnnotation(
            $this->testData->getInterfaceUsingMultipleConnectAnnotations()
        );
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new AnnotationService(
            new FileParser(),
            new AstReader(new NodeTraverser()),
            new ConnectAnnotationFinder(),
            new ClassFQCNBuilder()
        );
        $this->testData = new AnnotationServiceTestData();
    }
}
