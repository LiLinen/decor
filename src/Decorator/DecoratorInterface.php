<?php
declare(strict_types=1);

namespace LiLinen\Decor\Decorator;

use LiLinen\Decor\Decoration\DecorationInterface;

interface DecoratorInterface
{
    /**
     * @param string $name
     *
     * @return bool
     */
    public function supports(string $name): bool;

    /**
     * @param DecorationInterface $decoration
     *
     * @return callable|null
     */
    public function getBeforeFunction(DecorationInterface $decoration): ?callable;

    /**
     * @param DecorationInterface $decoration
     *
     * @return callable|null
     */
    public function getAfterFunction(DecorationInterface $decoration): ?callable;
}
