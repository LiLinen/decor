<?php
declare(strict_types=1);

namespace LiLinen\Decor\Decorator;

use Doctrine\Common\Collections\ArrayCollection;

class DecoratorCollection extends ArrayCollection
{
    /**
     * @param DecoratorInterface[] $elements
     */
    public function __construct(array $elements)
    {
        parent::__construct();

        foreach ($elements as $element) {
            $this->addDecorator($element);
        }
    }

    /**
     * @param DecoratorInterface $decorator
     */
    public function addDecorator(DecoratorInterface $decorator): void
    {
        $this->add($decorator);
    }
}
