<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface;

use Crusade\LaravelInterface\Annotation\ConnectAnnotation;
use Crusade\LaravelInterface\ValueObject\FullQualifiedClassNameVo;

final class AttributeFinder
{
    /**
     * @noinspection PhpIncompatibleReturnTypeInspection
     */
    public function findConnectAnnotation(
        FullQualifiedClassNameVo $class,
    ): ?ConnectAnnotation {
        try {
            $ref = new \ReflectionClass($class->toString());
        } catch (\ReflectionException $e) {
            throw new \LogicException($e->getMessage());
        }

        $attrs = $ref->getAttributes(ConnectAnnotation::class);

        if (array_key_exists(0, $attrs) === false) {
            return null;
        }

        return $attrs[0]->newInstance();
    }
}
