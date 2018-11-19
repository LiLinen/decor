<?php

namespace LiLinen\Decor\Decoration;

/**
 * @Annotation
 * @Target("METHOD")
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
