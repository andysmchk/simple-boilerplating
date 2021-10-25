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

How to start
============

To create your first templating and execute it you need minimum amount of configuration
```php
    use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions;
    use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;
    // use ...
    
    $definitions = new TemplateDefinitions();
    $definitions->add(new TemplateDefinition('path-the-source-file', 'path-to-the-destination-file', 'template-type'));
    
    (new TemplatingBuilder())
        ->setTemplatesBasePath(__DIR__)
        ->setWriterBasePath(__DIR__)
        ->addTemplateDefinitions($definitions)
        ->getTemplating()
        ->run();
```

Advanced usage
============
Advanced usage will be explained

```php
    use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitions;
    use Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinition;
    
    //...
            
    $builder = new TemplatingBuilder();
```
Writer
---------------
To use default writer provide directory for the base path

```php
    $builder->setWriterBasePath(__DIR__);
```

You can pass your own driver instance
```php
    // Create new class and implement \Rewsam\SimpleBoilerplating\Writer\Writer interface
    
    $builder->setWriter($writer);
```

Writer
---------------
To use default writer provide directory for the base path

```php
    $builder->setWriterBasePath(__DIR__);
```

You can pass your own driver instance
```php
    // Create new class and implement \Rewsam\SimpleBoilerplating\Writer\Writer interface
    
    $builder->setWriter($writer);
```

Template Builder
----------------
You can customize what templates are build by adding custom Template Builder
By default templates are build from template definitions builders

```php
    // Create new class and implement \Rewsam\SimpleBoilerplating\Template\TemplateBuilder interface

    $builder->addTemplateBuilder($builder);
```

Template Definitions Builder
----------------
You can customize what templates definitions are used to build templates by adding custom Template Definitions Builder
By default templates are build from template definitions

```php
    // Create new class and implement \Rewsam\SimpleBoilerplating\Template\TemplateDefinitionsBuilder interface

    $builder->addTemplateDefinitionsBuilder($builder);
```

For the array based configurations use tree builder 

```php
    use \Rewsam\SimpleBoilerplating\TemplateDefinition\TemplateDefinitionsTreeBuilder;
    //...
    $definitions = [
        [
            'source_directory' => 'test',
            'destination_directory' => 'dest',
            'files' => [
                [
                    'source' => 'from.txt',
                    'destination' => 'destination.php',
                    'mode' => 'dump',
                ],
                [
                    'source' => 'from0.txt',
                    'destination' => 'destination0.php',
                    'mode' => 'dump',
                ],
             ],
        ]
    ];

    $builder->addTemplateDefinitionsBuilder(new TemplateDefinitionsTreeBuilder($definitions))
```

Template Types
----------------
By default, you can use 2 types of templates ***dump*** and ***append***
Create new registry or use existing one and register new types

```php
    // Create new class and implement \Rewsam\SimpleBoilerplating\Template\TemplateTypeFactoryRegistry interface

    $builder->setTemplateTypeFactoryRegistry($factory);

    or

    $factory = new \Rewsam\SimpleBoilerplating\Template\DefaultTemplateTypeFactoryRegistry();
    // Create new class and implement \Rewsam\SimpleBoilerplating\Template\TemplateTypeFactory interface
    $factory->register('new-type', $typeFactory);
    $builder->setTemplateTypeFactoryRegistry($factory);
```

Dry Mode
----------------
When set as dry mode default writer will not perform write operations

```php
    $builder->setDryMode(true);
```

Allow Override
----------------
When set as allow override, default writer will replace existing files if they exist 
when set to false existing files will not be overwritten

```php
    $builder->setAllowOverride(true);
```

Template Definitions
----------------
Simplest way to pass templates definitions is to use collection and merge it to builder 

```php

    $definitions = new TemplateDefinitions();
    $definitions->add(new TemplateDefinition('path-the-source-file', 'path-to-the-destination-file', 'template-type'));

    $builder->addTemplateDefinitions($definitions);
```

Input Operator
----------------
Inout operators are responsible to provide input requirement descriptions and 
create parameters bags where requirements will be stored after fulfilment 

```php
    use \Rewsam\SimpleBoilerplating\Input\InputOperator;
    use \Rewsam\SimpleBoilerplating\Input\RequiredInputParameterDefinition;
    use \Rewsam\SimpleBoilerplating\ParameterBag\ArrayParametersBag;
    //...

    $operator = new class implements InputOperator {
        public function describe(InputParameterDefinitions $definitions): void
        {
            $definitions->add(new RequiredInputParameterDefinition('firstname', 'Firstname of the user'));
            $definitions->add(new RequiredInputParameterDefinition('lastname', 'Lastname of the user'));
        }
    
        public function instantiateBag(): ParametersBag
        {
            return new ArrayParametersBag();
        }
    }

    $builder->addInputOperator($operator);
```

Input Reactor
----------------
Sometimes user defined inout is not enough and template requires more precalculated values
to accomplish that requirement input reactors can be used 
Reactor can react to some particular bag or to all bags and add more values dynamically

```php
    use \Rewsam\SimpleBoilerplating\Input\InputReactor;

    $reactor = new class implements InputReactor {
        /** @param UsernameParametersBag $bag */
        public function react(ParametersBag $bag): void
        {
            $bag->set('username', sprintf('%s %s', $bag->getFirstname(), $bag->getLastname()));
        }
    
        public function supports(ParametersBag $bag): bool
        {
            return $bag instanceof UsernameParametersBag;
        }
    }

    $builder->addInputReactor($input, $output);
```

Console
----------------
To enable interactive input and more verbose logging pass Symfony console I/O interfaces  

```php
    // Create new class and implement Symfony\Component\Console\Input\InputInterface interface
    // Create new class and implement Symfony\Component\Console\Output\OutputInterface interface

    $builder->setConsoleInputOutput($input, $output);
```

InputParams
----------------
Some templates may require additional user defined input
One of the possible ways to achieve that is to pass parameters as a static associative array 

```php
    $builder->setInputParams([
        'key' => 'value'
    ]);
```

Driver
----------------
When not changed builder will use Mustache render driver.
You can change this behaviour and pass custom Driver

```php
    // Create new class and implement \Rewsam\SimpleBoilerplating\Render\RenderAdapter interface

    $builder->setDriver($driver);
```

Validator
----------------
By default, symfony basic validator configuration is used. 
You can pass your own instance of validator to customize configuration

```php
    // Create new class and implement \Symfony\Component\Validator\Validator\ValidatorInterface interface

    $builder->setValidator($validator);
```
