<?php
declare(strict_types=1);

namespace LiLinen\Decor\Factory;

use LiLinen\Decor\Decorator\DecoratorCollection;
use LiLinen\Decor\Decorator\DecoratorInterface;
use ProxyManager\Factory\AccessInterceptorValueHolderFactory;

final class ProxyFactory
{
    /**
     * @var AccessInterceptorValueHolderFactory
     */
    private $proxyFactory;

    /**
     * @var DecoratorCollection
     */
    private $decoratorCollection;

    /**
     * @param AccessInterceptorValueHolderFactory $proxyFactory
     * @param DecoratorCollection $collection
     */
    public function __construct(AccessInterceptorValueHolderFactory $proxyFactory, DecoratorCollection $collection)
    {
        $this->proxyFactory = $proxyFactory;
        $this->decoratorCollection = $collection;
    }

    /**
     * @inheritdoc
     */
    public function create(object $instance, array $decorations): object
    {
        $proxy = $this->proxyFactory->createProxy($instance);

        foreach ($decorations as $decorationName => $proxyData) {
            /** @var DecoratorInterface $decorator */
            foreach ($this->decoratorCollection as $decorator) {
                if (!$decorator->supports($decorationName)) {
                    continue;
                }

                foreach ($proxyData as $methodName => $decoration) {
                    $prefix = $decorator->getBeforeFunction($decoration);
                    if ($prefix !== null) {
                        $proxy->setMethodPrefixInterceptor($methodName, $prefix);
                    }

                    $suffix = $decorator->getAfterFunction($decoration);
                    if ($suffix !== null) {
                        $proxy->setMethodSuffixInterceptor($methodName, $suffix);
                    }
                }
            }
        }

        return $proxy;
    }
}
