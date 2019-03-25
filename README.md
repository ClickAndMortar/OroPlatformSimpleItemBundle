# Simple Item bundle - C&M

Simple Item bundle is a bundle for OroPlatform / OroCRM project. It allows to create editable lists from the interface.

Made with :blue_heart: by C&M

## Installation

### Download the Bundle

```console
$ composer require clickandmortar/oro-platform-simple-item-bundle
```

### Enable the Bundle

Enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new ClickAndMortar\SimpleItemBundle\ClickAndMortarSimpleItemBundle(),
        ];

        // ...
    }

    // ...
}
```