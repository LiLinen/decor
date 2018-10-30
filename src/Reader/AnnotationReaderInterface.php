<?php

declare(strict_types=1);

namespace LiLinen\Decor\Reader;

interface AnnotationReaderInterface
{
    /**
     * @param \ReflectionClass $reflectionClass
     *
     * @return array
     */
    public function read(\ReflectionClass $reflectionClass): array;
}
