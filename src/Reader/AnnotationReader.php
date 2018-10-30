<?php

declare(strict_types=1);

namespace LiLinen\Decor\Reader;

use Doctrine\Common\Annotations\Reader;
use LiLinen\Decor\Decoration\DecorationInterface;

class AnnotationReader implements AnnotationReaderInterface
{
    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->annotationReader = $reader;
    }

    /**
     * @inheritdoc
     */
    public function read(\ReflectionClass $reflectionClass): array
    {
        $decoratedMethods = [];

        foreach ($reflectionClass->getMethods() as $method) {
            $annotations = $this->annotationReader->getMethodAnnotations($method);

            foreach ($annotations as $annotation) {
                if (!($annotation instanceof DecorationInterface)) {
                    continue;
                }

                $decoratedMethods[$annotation->getName()][$method->getName()] = $annotation;
            }
        }

        return $decoratedMethods;
    }
}
