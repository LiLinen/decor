<?php
declare(strict_types=1);

namespace LiLinen\Decor;

use LiLinen\Decor\Exception\DecorationException;

class DecorationFactory
{
    /**
     * @var DecorationService
     */
    private $decorator;

    /**
     * @var string
     */
    private $class;

    /**
     * @param DecorationService $decorator
     * @param string $class
     */
    public function __construct(DecorationService $decorator, string $class)
    {
        $this->decorator = $decorator;
        $this->class = $class;
    }

    /**
     * @param mixed ...$params
     *
     * @return object
     *
     * @throws DecorationException
     */
    public function create(...$params): object
    {
        return $this->decorator->decorate($this->class, $params);
    }
}
