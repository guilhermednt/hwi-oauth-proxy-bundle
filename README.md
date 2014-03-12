http-service-bundle
===================

Currently, this bundle turns Guzzle HTTP Client into a service to allow application wide configuration (like curl proxy settings).

It uses a `ClientFactory` so that you can adapt it to other HTTP Clients.

## Installation

### Step 1: Add package as requirement in Composer

Add the bundle to your `composer.json`:

``` js
{
    "require": {
        "guilhermednt/http-service-bundle": "dev-master"
    }
}
```

Then run the update command:

``` bash
$ composer update guilhermednt/http-service-bundle
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
        new Donato\HttpServiceBundle\DonatoHttpServiceBundle(),
    );
}
```

### Step 3: Add desired parameters

This bundle does not require you to change `config.yml`, so that you can have different configuration scenarios for each environment you have.

The minimum configuration needed is this:

``` yaml
# app/config/parameters.yml

parameters:
    http_client_factory_class: Donato\HttpServiceBundle\Factory\ClientFactory
    http_client_config: ~
```

Below you can see an **example** for *HTTP Proxy with Authentication*:

``` yaml
# app/config/parameters.yml

imports:
    - { resource: constants.php }

parameters:
    # ... your regular parameters ...
    
    http_client_factory_class: Donato\HttpServiceBundle\Factory\ClientFactory
    http_client_config:
        curl:
            %curl.proxy.type%: HTTP
            %curl.proxy.host%: my.proxy.example.com
            %curl.proxy.port%: 1234
            %curl.proxy.auth%: username:password
```

**Note** that the CURL constants are introduced via **constants.php** as follows:

``` php
<?php
// app/config/constants.php

$container->setParameter('curl.proxy.type', CURLOPT_PROXYTYPE);
$container->setParameter('curl.proxy.host', CURLOPT_PROXY);
$container->setParameter('curl.proxy.port', CURLOPT_PROXYPORT);
$container->setParameter('curl.proxy.auth', CURLOPT_PROXYUSERPWD);
```

### That's it!

Now you can start using the service named `http_client_factory`. To instantiate a `Guzzle\Http\Client` you may just do the following:

``` php
<?php
// SomeController.php
    public function someAction()
    {
        // ...
        
        $clientFactory = $this->get('http_client_factory');
        $client = $clientFactory->getGuzzleClient();
        
        // ...
    }
```
