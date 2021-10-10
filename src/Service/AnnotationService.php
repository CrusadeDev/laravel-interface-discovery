<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\Service;

use Crusade\LaravelInterface\AstReader;
use Crusade\LaravelInterface\AttributeFinder;
use Crusade\LaravelInterface\ClassFQCNBuilder;
use Crusade\LaravelInterface\FileParser;
use Crusade\LaravelInterface\ValueObject\File;
use Crusade\LaravelInterface\ValueObject\FullQualifiedClassNameVo;

final class AnnotationService
{
    private FileParser $fileParser;
    private AstReader $astReader;
    private AttributeFinder $attributeFinder;
    private ClassFQCNBuilder $classFQCNBuilder;

    public function __construct()
    {
        $this->fileParser = new FileParser();
        $this->astReader = new AstReader();
        $this->attributeFinder = new AttributeFinder();
        $this->classFQCNBuilder = new ClassFQCNBuilder();
    }

    /**
     * @TODO change array to object
     * @return array<string, FullQualifiedClassNameVo>|null
     */
    public function handle(File $file): ?array
    {
        $ast = $this->fileParser->parse($file);
        $namespace = $this->astReader->findNamespace($ast);

        if ($namespace === null) {
            return null;
        }

        $interfaceName = $this->astReader->findInterface($ast);

        if ($interfaceName === null) {
            return null;
        }

        $fqcn = $this->classFQCNBuilder->buildFQCN($namespace, $interfaceName);

        $attribute = $this->attributeFinder->findConnectAnnotation($fqcn);

        if ($attribute === null) {
            return null;
        }

        return [$fqcn->toString() => $attribute->getImplementation()];
    }
}
