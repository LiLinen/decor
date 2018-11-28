<?php

declare(strict_types=1);

namespace LiLinen\Decor\Decorator\Memoize;

interface KeyMakerInterface
{
    public function makeKey(object $instance, string $method, array $parameters): string;
}
