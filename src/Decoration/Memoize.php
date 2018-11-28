<?php

declare(strict_types=1);

namespace LiLinen\Decor\Decoration;

/**
 * @Annotation
 * @Target("METHOD")
 *
 * @see \LiLinen\Decor\Decorator\MemoizeDecorator
 */
final class Memoize extends AbstractDecoration
{
    /**
     * @var ?int
     */
    private $ttl = null;

    /**
     * @param int|null $ttl
     */
    public function setTtl(?int $ttl): void
    {
        $this->ttl = $ttl;
    }

    /**
     * @return int|null
     */
    public function getTtl(): ?int
    {
        return $this->ttl;
    }
}
