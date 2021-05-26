# Simple Item bundle - C&M

Simple Item bundle is a bundle for OroPlatform / OroCRM project. It allows to create editable lists from the interface.

Made with :blue_heart: by C&M

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
php bin/console fos:js-routing:dump --no-interaction
php bin/console oro:localization:dump --no-interaction
php bin/console assets:install --symlink --relative --no-interaction
php bin/console oro:assets:build --no-interaction
php bin/console cache:clear --no-interaction
php bin/console oro:translation:dump --no-interaction
```