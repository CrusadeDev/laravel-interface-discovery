<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests;

use Crusade\LaravelInterface\AttributeFinder;
use Crusade\LaravelInterface\Tests\TestData\FileWithAnnotation;
use Crusade\LaravelInterface\Tests\TestData\FileWithClass;
use Crusade\LaravelInterface\ValueObject\FullQualifiedClassNameVo;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class AttributeFinderTest extends TestCase
{
    private AttributeFinder $finder;

    public function test_getAttribute_ShouldReturnAttributeWhenPresent(): void
    {
        $result = $this->finder->findConnectAnnotation(new FullQualifiedClassNameVo(FileWithAnnotation::class));

        assertEquals(FileWithClass::class, $result->getImplementation());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->finder = new AttributeFinder();
    }
}
