<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface;

use Crusade\LaravelInterface\Annotation\ConnectAnnotation;
use Crusade\LaravelInterface\ValueObject\FullQualifiedClassNameVo;

class AttributeFinder
{
    /**
     * @noinspection PhpIncompatibleReturnTypeInspection
     */
    public function findConnectAnnotation(
        FullQualifiedClassNameVo $class,
    ): ?ConnectAnnotation {
        try {
            $ref = new \ReflectionClass((string) $class);
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
