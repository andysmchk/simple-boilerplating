![workflow](https://github.com/andysmchk/simple-boilerplating/actions/workflows/test.yml/badge.svg)

Installation
============


KnpMenu uses Composer, please checkout the [composer website](http://getcomposer.org) for more information.

The simple following command will install `knp-menu` into your project. It also add a new
entry in your `composer.json` and update the `composer.lock` as well.

```bash
$ composer require rewsam/simple-boilerplating
```

> SimpleBoilerplating follows the PSR-4 convention names for its classes, which means you can easily integrate `simple-boilerplating` classes loading in your own autoloader.

Usage
============

Simplified usage example with builder

```php
// use ...

// ...
    $definitions = new TemplateDefinitions('public/test', 'public/dest');
    $definitions->addTemplate('from.txt', 'destination.php', 'dump');
    $definitions->addTemplate('from0.txt', 'destination0.php', 'dump');

    $parameters = new InputParameterDefinitions();
    $parameters->add(new InputParameterDefinition('firstname', 'User Firstname', new NotNull(), new NotBlank()));
    $parameters->add(new InputParameterDefinition('lastname', 'User Lastname', new NotNull(), new NotBlank()));

    $templating = (new TemplatingBuilder())
                ->addTemplateDefinitions($definitions)
                ->addInputParameterDefinitions($parameters)
                ->setInputParams([
                    'firstname' => 'Foo',
                    'lastname' => 'Bar',
                ])
                ->setDryMode(false)
                ->setAllowOverride(true)
                ->setApplicationBasePath(__DIR__ . '/..')
                ->build();

    $templating->run();
```