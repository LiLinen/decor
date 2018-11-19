<?php

namespace LiLinen\Decor\Decorator;

use LiLinen\Decor\Decoration\DecorationInterface;
use LiLinen\Decor\Decoration\Log;
use Psr\Log\LoggerInterface;

class LogDecorator implements DecoratorInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function supports(string $name): bool
    {
        return $name === Log::class;
    }

    /**
     * @param DecorationInterface|Log $decoration
     * @return callable|null
     */
    public function getBeforeFunction(DecorationInterface $decoration): ?callable
    {
        return function($proxy, $instance, $method, $params, & $returnEarly) use ($decoration) {
            if ($decoration->logBefore() === true) {
                
            }
        };
    }

    /**
     * @param DecorationInterface|Log $decoration
     * @return callable|null
     */
    public function getAfterFunction(DecorationInterface $decoration): ?callable
    {
        return function($proxy, $instance, $method, $params, $returnValue, & $returnEarly) use ($decoration) {

        };
    }
}
