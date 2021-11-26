<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\UseCase\DiscoverInterfaces\tests;

use Crusade\LaravelInterface\Shared\ValueObject\FileContent;

final class AnnotationServiceTestData
{
    private const INTERFACE_NAME = 'ExampleInterface.php';
    private const EXAMPLE_IMPLEMENTATION = 'ExampleImplementation.php';

    public function getInterfaceUsingAnnotationWithImplementation(): FileContent
    {
        return new FileContent(
            file_get_contents(
                $this->pathBuilder(
                    'InterfaceAndImplementationUsingAnnotation',
                    self::INTERFACE_NAME
                )
            )
        );
    }

    public function getInterfaceNotUsingAnnotation(): FileContent
    {
        return new FileContent(
            file_get_contents(
                $this->pathBuilder(
                    'InterfaceNotUsingAnnotation',
                    self::INTERFACE_NAME,
                )
            )
        );
    }

    public function getInterfaceUsingAnnotationWithoutImplementation(): FileContent
    {
        return new FileContent(
            file_get_contents(
                $this->pathBuilder(
                    'InterfaceUsingAnnotationWithoutImplementation',
                    self::INTERFACE_NAME,
                )
            )
        );
    }

    public function getImplementation(): FileContent
    {
        return new FileContent(
            file_get_contents(
                $this->pathBuilder(
                    'ClassWithoutInterface',
                    self::EXAMPLE_IMPLEMENTATION,
                )
            )
        );
    }

    public function getInterfaceWithoutNamespace(): FileContent
    {
        return new FileContent(
            file_get_contents(
                $this->pathBuilder(
                    'InterfaceWithoutNamespace',
                    self::INTERFACE_NAME
                )
            )
        );
    }

    public function getInterfaceUsingAnnotationWithoutExistingImplementation(): FileContent
    {
        return new FileContent(
            file_get_contents(
                $this->pathBuilder(
                    'InterfaceWithAnnotationWithNonExistingImplementation',
                    self::INTERFACE_NAME
                )
            )
        );
    }

    public function getInterfaceUsingAnnotationWithInterfaceAsImplementation(): FileContent
    {
        return new FileContent(
            file_get_contents(
                $this->pathBuilder(
                    'InterfaceUsingAnnotationWithInterfaceAsImplementation',
                    self::INTERFACE_NAME
                )
            )
        );
    }

    public function getInterfaceUsingMultipleConnectAnnotations(): FileContent
    {
        return new FileContent(
            file_get_contents(
                $this->pathBuilder(
                    'InterfaceWithMultipleConnectAnnotation',
                    self::INTERFACE_NAME
                )
            )
        );
    }

    private function pathBuilder(string $fileFolder, string $fileName): string
    {
        return sprintf('%s/AnnotationServiceTestData/%s/%s', __DIR__, $fileFolder, $fileName);
    }
}
