<?php

declare(strict_types=1);

namespace LiLinen\Decor\Decorator;

use LiLinen\Decor\Decoration\DecorationInterface;
use LiLinen\Decor\Decoration\Profile;
use LiLinen\Decor\Exception\DecorationException;
use Psr\Log\LoggerInterface;

class ProfileDecorator implements DecoratorInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var float|null
     */
    private $startTime;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function supports(string $name): bool
    {
        return $name === Profile::class;
    }

    /**
     * @param DecorationInterface|Profile $decoration
     *
     * @return callable|null
     *
     * @throws DecorationException
     */
    public function getBeforeFunction(DecorationInterface $decoration): ?callable
    {
        if (!($decoration instanceof Profile)) {
            throw new DecorationException('Decoration '.\get_class($decoration).' must be instanceof Profile!');
        }

        return function () {
            $this->startTime = \microtime(true);
        };
    }

    /**
     * @param DecorationInterface|Profile $decoration
     *
     * @return callable|null
     *
     * @throws DecorationException
     */
    public function getAfterFunction(DecorationInterface $decoration): ?callable
    {
        if (!($decoration instanceof Profile)) {
            throw new DecorationException('Decoration '.\get_class($decoration).' must be instanceof Profile!');
        }

        return function ($proxy, $instance, $method, $params, $returnValue) use ($decoration) {
            $endTime = \microtime(true);
            $totalTime = $endTime - $this->startTime;

            $context = [];
            $context['profile'] = [
                    'total' => $totalTime,
                    'start' => $this->startTime,
                    'end' => $endTime,
            ];

            if ($decoration->getIncludeMetadata() === true) {
                $context['meta'] = [
                    'class' => \get_class($instance),
                    'method' => $method,
                    'params' => $params,
                    'returnValue' => $returnValue,
                ];
            }

            $this->logger->log($decoration->getLevel(), $decoration->getMessage(), $context);
        };
    }
}
