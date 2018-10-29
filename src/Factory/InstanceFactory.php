<?php
declare(strict_types=1);

namespace LiLinen\Decor\Factory;

final class InstanceFactory implements InstanceFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(\ReflectionClass $reflectionClass, array $params): object
    {
        if (\count($params) === 0) {
            $className = $reflectionClass->getName();
            return new $className;
        }

        return $reflectionClass->newInstanceArgs($params);
    }
}
