<?php

declare(strict_types=1);

namespace LiLinen\Decor;

use LiLinen\Decor\Exception\DecorationException;
use LiLinen\Decor\Factory\InstanceFactoryInterface;
use LiLinen\Decor\Factory\ProxyFactoryInterface;
use LiLinen\Decor\Reader\AnnotationReaderInterface;

class DecorationService
{
    /**
     * @var AnnotationReaderInterface
     */
    private $reader;

    /**
     * @var InstanceFactoryInterface
     */
    private $instanceFactory;

    /**
     * @var ProxyFactoryInterface
     */
    private $proxyFactory;

    /**
     * @param AnnotationReaderInterface $reader
     * @param InstanceFactoryInterface $instanceFactory
     * @param ProxyFactoryInterface $proxyFactory
     */
    public function __construct(
        AnnotationReaderInterface $reader,
        InstanceFactoryInterface $instanceFactory,
        ProxyFactoryInterface $proxyFactory
    ) {
        $this->reader = $reader;
        $this->instanceFactory = $instanceFactory;
        $this->proxyFactory = $proxyFactory;
    }

    /**
     * @param string $className
     * @param array $parameters
     *
     * @return object
     *
     * @throws DecorationException
     */
    public function decorate(string $className, array $parameters): object
    {
        try {
            return $this->doDecorate($className, $parameters);
        } catch (\Throwable $exception) {
            throw new DecorationException("", 0, $exception);
        }
    }

    /**
     * @param string $className
     * @param array $parameters
     *
     * @return object
     *
     * @throws \ReflectionException
     */
    private function doDecorate(string $className, array $parameters): object
    {
        $reflectionClass = new \ReflectionClass($className);

        $decorations = $this->reader->read($reflectionClass);
        $instance = $this->instanceFactory->create($reflectionClass, $parameters);

        if (empty($decorations)) {
            return $instance;
        }

        return $this->proxyFactory->create($instance, $decorations);
    }
}
