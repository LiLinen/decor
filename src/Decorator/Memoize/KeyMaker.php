<?php

namespace LiLinen\Decor\Decorator\Memoize;

class KeyMaker implements KeyMakerInterface
{
    /**
     * @param object $instance
     * @param string $method
     * @param array $parameters
     *
     * @return string
     */
    public function makeKey(object $instance, string $method, array $parameters): string
    {
        return \get_class($instance) . '_' . $method . '_' . \md5(\serialize($parameters));
    }
}
