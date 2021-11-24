<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface;

use Crusade\LaravelInterface\Annotation\ConnectAnnotation;
use Crusade\LaravelInterface\Exception\AttributeDoesNotContainsRequiredArgumentsException;
use Crusade\LaravelInterface\Exception\ImplementationMustBeAClassException;
use Crusade\LaravelInterface\Exception\InterfaceImplementsMultipleConnectionAnnotationException;
use Crusade\LaravelInterface\ValueObject\FullQualifiedClassNameVo;
use ReflectionAttribute;

final class ConnectAnnotationFinder
{
    /**
     * @throws AttributeDoesNotContainsRequiredArgumentsException
     * @throws Exception\ClassOrInterfaceDoesNotExistException
     * @throws ImplementationMustBeAClassException
     * @throws InterfaceImplementsMultipleConnectionAnnotationException
     */
    public function findConnectAnnotation(FullQualifiedClassNameVo $className): ?ConnectAnnotation
    {
        try {
            $ref = new \ReflectionClass($className->toString());
        } catch (\ReflectionException $e) {
            throw new \LogicException($e->getMessage());
        }

        $attrs = $ref->getAttributes(ConnectAnnotation::class);

        $this->validateIfOnlyOneInstanceOfAttributeWasFound($attrs, $className);

        if (array_key_exists(0, $attrs) === false) {
            return null;
        }

        $reflectionAttribute = $attrs[0];

        $this->validateAttributeContainsRequiredArguments($reflectionAttribute, $className);

        /** @var ConnectAnnotation $instance */
        $instance = $reflectionAttribute->newInstance();

        $this->validateImplementationIsClass($instance);

        return $instance;
    }

    /**
     * @throws InterfaceImplementsMultipleConnectionAnnotationException
     */
    private function validateIfOnlyOneInstanceOfAttributeWasFound(
        array $foundAttributes,
        FullQualifiedClassNameVo $className
    ): void {
        if (count($foundAttributes) <= 1) {
            return;
        }

        throw new InterfaceImplementsMultipleConnectionAnnotationException(
            sprintf(
                'interface should implements only one instance of connect annotation interface: %s',
                $className->toString()
            )
        );
    }

    /**
     * @throws AttributeDoesNotContainsRequiredArgumentsException
     */
    private function validateAttributeContainsRequiredArguments(
        ReflectionAttribute $connectAnnotation,
        FullQualifiedClassNameVo $class
    ): void {
        $attr = $connectAnnotation->getArguments();

        if (count($attr) > 0) {
            return;
        }

        throw new AttributeDoesNotContainsRequiredArgumentsException(
            sprintf('Annotation does not contains required arguments: %s', $class->toString())
        );
    }

    /**
     * @throws Exception\ClassOrInterfaceDoesNotExistException
     * @throws ImplementationMustBeAClassException
     */
    private function validateImplementationIsClass(ConnectAnnotation $instance): void
    {
        $implementation = $instance->getImplementation();
        if (class_exists($implementation->toString()) === true) {
            return;
        }

        throw new ImplementationMustBeAClassException(
            sprintf('implementation must be a class given implementation: %s', $implementation)
        );
    }
}
