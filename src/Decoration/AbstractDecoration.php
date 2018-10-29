<?php
declare(strict_types=1);

namespace LiLinen\Decor\Decoration;

abstract class AbstractDecoration implements DecorationInterface
{
    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return \get_class($this);
    }
}
