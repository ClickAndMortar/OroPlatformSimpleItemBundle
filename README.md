# Simple Item bundle - C&M

Simple Item bundle is a bundle for OroPlatform / OroCRM project. It allows to create editable lists from the interface.

Made with :blue_heart: by C&M

## Requirements

|                                     | Version |
| ----------------------------------- | ------- |
| PHP                                 | `>=7.1` |
| OroPlatform / OroCrm                | `>=3.1` |

## Installation

### Download the Bundle

```console
$ composer require clickandmortar/oro-platform-simple-item-bundle
```

### Enable the Bundle

Bundle is enabled automatically by `bundles.yml` file.
Run only following commands:

```
php bin/console cache:clear
php bin/console doctrine:schema:update --force
php bin/console oro:entity-config:update --filter="ClickAndMortar*" --force
php bin/console oro:migration:load --force --bundles="ClickAndMortarSimpleItemBundle"
php bin/console oro:migration:data:load --bundles="ClickAndMortarSimpleItemBundle"
```