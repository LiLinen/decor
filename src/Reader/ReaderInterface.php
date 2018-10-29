<?php
declare(strict_types=1);

namespace LiLinen\Decor\Reader;

interface ReaderInterface
{
    /**
     * @param \ReflectionClass $reflectionClass
     *
     * @return array
     */
    public function read(\ReflectionClass $reflectionClass): array;
}
