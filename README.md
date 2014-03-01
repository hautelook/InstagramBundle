InstagramBundle
===============

A Symfony2 bundle to work with the Instagram API.

[![Build Status](https://travis-ci.org/hautelook/InstagramBundle.png?branch=master)](https://travis-ci.org/hautelook/InstagramBundle)


## Introduction

This bundle provides a new bundle that uses the Instaphp library to leverage the Instagram API.

## Installation

Simply run assuming you have installed composer.phar or composer binary (or add to your `composer.json` and run composer
install:

```bash
$ composer require hautelook/instagram-bundle
```

You can follow `dev-master`, or use a more stable tag (recommended for various reasons). On the
[Github repository](https://github.com/hautelook/InstagramBundle), or on [Packagist](http://www.packagist.org), you can
always find the latest tag.

Now add the Bundle to your Kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
        new Hautelook\InstagramBundle\HautelookInstagramBundle(),
        // ...
    );
}
```

## Configuration

You can configure the bundle by defining:

```yaml
# app/config/hautelook_instagram.yml

hautelook_instagram:
    instaphp_params:
        client_id: <your client id>
        client_secret: <your client secret>
    user_id: <your user id>
```

## Usage

Simply get the manager service and call ```getRecent```. Example

```php
<?php

namespace Acme\DemoBundle;

class SomeController extends Controller
{
    public function someAction()
    {
        $instagramManager = $this->get('hautelook_instagram.manager');
        $posts = $instagramManager->getRecent(5);
    }
}
```

## Future and ToDos:

- Clean up
- Add more functionality
