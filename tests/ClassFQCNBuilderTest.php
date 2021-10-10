<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Tests;

use Crusade\LaravelInterface\ClassFQCNBuilder;
use Crusade\LaravelInterface\Tests\TestData\FileWithClass;
use Crusade\LaravelInterface\ValueObject\ClassVo;
use Crusade\LaravelInterface\ValueObject\NamespaceVo;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PHPUnit\Framework\TestCase;

final class ClassFQCNBuilderTest extends TestCase
{
    private ClassFQCNBuilder $builder;

    public function test_build_shouldReturnFQCN(): void
    {
        $result = $this->builder->buildFQCN($this->getNamespace(), $this->getClass());

        self::assertEquals(FileWithClass::class, $result->toString());
    }

    private function getNamespace(): NamespaceVo
    {
        return new NamespaceVo(new Namespace_(new Name('Crusade\LaravelInterface\Tests\TestData')));
    }

    private function getClass(): ClassVo
    {
        return new ClassVo(new Class_('FileWithClass'));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = new ClassFQCNBuilder();
    }
}
