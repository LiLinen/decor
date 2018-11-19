<?php

namespace LiLinen\Decor\Decoration;

/**
 * @Annotation
 */
final class Log extends AbstractDecoration
{
    private $on;

    /**
     * @return string
     */
    public function getOn(): string
    {
        return $this->on;
    }

    /**
     * @param string $on
     */
    public function setOn(string $on): void
    {
        $this->on = $on;
    }

    /**
     * @return bool
     */
    public function logBefore(): bool
    {
    }

    /**
     * @return bool
     */
    public function logAfter(): bool
    {
    }
}
