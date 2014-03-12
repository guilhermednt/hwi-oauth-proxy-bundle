hwi-oauth-proxy-bundle
======================

This bundle extends HWIOAuthBundle to be able to extend the Curl client from Buzz.

## Installation

### Step 1: Add package as requirement in Composer

Add the bundle to your `composer.json`:

``` js
{
    "require": {
        "guilhermednt/hwi-oauth-proxy-bundle": "dev-master"
    }
}
```

Then run the update command:

``` bash
$ composer update guilhermednt/hwi-oauth-proxy-bundle
```

### Step 2: Tell Symfony2 about it.

Enable the bundle in your `AppKernel.php`:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Donato\Generic\HWIOAuthProxyBundle\DonatoGenericHWIOAuthProxyBundle(),
    );
}
```

### Step 3: Add desired parameters

This bundle does not require you to change `config.yml`, so that you can have different configuration scenarios for each environment you have.

The minimum configuration needed is this:

``` yaml
# app/config/parameters.yml

parameters:
    http_proxy: ~
```

Below you can see an **example** for *HTTP Proxy with Authentication*:

``` yaml
# app/config/parameters.yml

imports:
    - { resource: constants.php }

parameters:
    # ... your regular parameters ...

    http_proxy:
        type: HTTP
        host: my.proxy.example.com
        port: 1234
        auth: username:password
```

### That's it!

Now you can use `HWIOAuthBundle` normally and it will work behind your proxy!
