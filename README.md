# Symfony Prelude

A simple loader for Symfony DI containers.

## Purpose

If you want to use Symfony components without using the full framework, this tool gives you a simple and consistent way to load a Dependency Injection container from YAML files without boilerplate code.

## Usage

Create a central file where you get the container for the root directory of your project:

**bootstrap.php**

```
<?php
require_once 'vendor/bootstrap.php';

$container = SymfonyPrelude\ContainerLoader::containerForDirectory($rootDirectory);
```

Now create two YAML files to configure the DI container:

**app/services.yml**

```
services:
  my_service:
    class: Acme\MyClass
    arguments:
      - "%some_param%"
      - "%root_dir%"
```

(The `root_dir` parameter is provided automatically by the loader.) 

**app/parameters.yml**

```
parameters:
  some_param: 'SECRET_KEY'
  other_param: 1234
```

You can now use `$container` in your application. It's a normal Symfony DI ContainerBuilder, configured from theses YAML files.

## Local overrides

Optionally you can create a third config file to override parameters or services:

**app/override.yml**

```
parameters:
  server_host: dev-server-host
  
services:
  my_service:
    class: Acme\AnotherClass
```

The override file is not required.
