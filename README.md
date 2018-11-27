# Decor

[![Build Status](https://travis-ci.org/LiLinen/decor.svg?branch=master)](https://travis-ci.org/LiLinen/decor)

Add method decorations with annotations.
 
## Installation
 
`composer require lilinen/decor`

## Usage

### Creating custom decorations

Create a decoration annotation:
```php
<?php
// src/Decoration/MyDecoration.php

namespace App\Decoration;

use LiLinen\Decor\Decoration\AbstractDecoration;

/**
 * @Annotation
 * @Target("METHOD")
 */
final class MyDecoration extends AbstractDecoration
{
}
```

Create a decorator:
```php
<?php
// src/Decorator/MyDecorator.php

namespace App\Decorator;

use App\Decoration\MyDecoration;
use LiLinen\Decor\Decorator\DecoratorInterface;
use LiLinen\Decor\Decoration\DecorationInterface;

class MyDecorator implements DecoratorInterface
{
    public function supports(string $name): bool
    {
        return $name === MyDecoration::class;
    }

    public function getBeforeFunction(DecorationInterface $decoration): ?callable
    {
        return function ($proxy, $instance, $method, $params, &$returnEarly) {
            // Add logic
        };
    }

    public function getAfterFunction(DecorationInterface $decoration): ?callable
    {
        return function ($proxy, $instance, $method, $params, $returnValue, & $returnEarly) use ($decoration) {
            // Add logic
        };
    }
}
```

## Related Projects

* [decor-bundle](https://github.com/LiLinen/decor-bundle)
* [decor-example](https://github.com/LiLinen/decor-example)
