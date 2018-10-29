<?php
declare(strict_types=1);

namespace LiLinen\Decor\Factory;

interface ProxyFactoryInterface
{
    /**
     * @param object $instance
     * @param array $decorations
     *
     * @return object
     */
    public function create(object $instance, array $decorations): object;
}
