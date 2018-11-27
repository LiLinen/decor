<?php

namespace LiLinen\Decor\Decorator;

use LiLinen\Decor\Decoration\DecorationInterface;
use LiLinen\Decor\Decoration\Memoize;
use LiLinen\Decor\Decorator\Memoize\KeyMakerInterface;
use LiLinen\Decor\Exception\DecorationException;
use Psr\SimpleCache\CacheInterface;

class MemoizeDecorator implements DecoratorInterface
{
    /**
     * @var \Psr\SimpleCache\CacheInterface
     */
    private $cache;

    /**
     * @var KeyMakerInterface
     */
    private $keyMaker;

    /**
     * @param \Psr\SimpleCache\CacheInterface $cache
     * @param \LiLinen\Decor\Decorator\Memoize\KeyMakerInterface $keyMaker
     */
    public function __construct(CacheInterface $cache, KeyMakerInterface $keyMaker)
    {
        $this->cache = $cache;
        $this->keyMaker = $keyMaker;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function supports(string $name): bool
    {
        return $name === Memoize::class;
    }

    /**
     * @param DecorationInterface|Memoize $decoration
     *
     * @return callable|null
     *
     * @throws DecorationException
     */
    public function getBeforeFunction(DecorationInterface $decoration): ?callable
    {
        if (!($decoration instanceof Memoize)) {
            throw new DecorationException('Decoration '.\get_class($decoration).' must be instanceof Memoize!');
        }

        return function ($proxy, $instance, $method, $params, &$returnEarly) {
            $key = $this->keyMaker->makeKey($instance, $method, $params);

            if ($this->cache->has($key) === false) {
                return;
            }

            $returnEarly = true;

            return $this->cache->get($key);
        };
    }

    /**
     * @param DecorationInterface|Memoize $decoration
     *
     * @return callable|null
     *
     * @throws DecorationException
     */
    public function getAfterFunction(DecorationInterface $decoration): ?callable
    {
        if (!($decoration instanceof Memoize)) {
            throw new DecorationException('Decoration '.\get_class($decoration).' must be instanceof Memoize!');
        }

        return function ($proxy, $instance, $method, $params, $returnValue, & $returnEarly) use ($decoration) {
            $key = $this->keyMaker->makeKey($instance, $method, $params);

            if ($this->cache->has($key) === true) {
                return;
            }

            $this->cache->set($key, $returnValue, $decoration->getTtl());
        };
    }
}
