<?php
declare(strict_types=1);

namespace LiLinen\Decor\Factory;

interface InstanceFactoryInterface
{
    /**
     * @param \ReflectionClass $reflectionClass
     * @param array $params
     *
     * @return object
     */
    public function create(\ReflectionClass $reflectionClass, array $params): object;
}
