## Google reCAPTCHA Client

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sunrise-php/recaptcha/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sunrise-php/recaptcha/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/sunrise-php/recaptcha/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/sunrise-php/recaptcha/?branch=master)
[![Total Downloads](https://poser.pugx.org/sunrise/recaptcha/downloads?format=flat)](https://packagist.org/packages/sunrise/recaptcha)

## Installation

```bash
composer require sunrise/recaptcha
```

## How to use

### Quick Start

```php
// TODO
```

### PHP-DI definitions

```php
use DI\ContainerBuilder;
use Sunrise\Recaptcha\RecaptchaVerificationClientInterface;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinition(__DIR__ . '/../vendor/sunrise/recaptcha/resources/definitions/verification.php');

$container = $containerBuilder->build();

// See above for usage examples.
$recaptchaClient = $container->get(RecaptchaVerificationClientInterface::class);
```

## Tests

```bash
composer test
```
