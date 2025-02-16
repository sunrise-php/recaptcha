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

```bash
composer require sunrise/http-client-curl sunrise/http-message
```

```php
use Sunrise\Coder\CodecManager;
use Sunrise\Coder\Codec\UrlEncodedCodec;
use Sunrise\Http\Client\Curl\Client;
use Sunrise\Http\Message\RequestFactory;
use Sunrise\Http\Message\ResponseFactory;
use Sunrise\Hydrator\Hydrator;
use Sunrise\Recaptcha\Dto\RecaptchaVerificationRequest;
use Sunrise\Recaptcha\RecaptchaVerificationClient;
use Sunrise\Recaptcha\RecaptchaVerificationConfiguration;

// https://developers.google.com/recaptcha/docs/faq
$privateKey = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

$client = new RecaptchaVerificationClient(
    verificationConfiguration: new RecaptchaVerificationConfiguration(privateKey: $privateKey),
    httpRequestFactory: new RequestFactory(),
    httpClient: new Client(new ResponseFactory()),
    codecManager: new CodecManager([new UrlEncodedCodec()]),
    hydrator: new Hydrator(),
);

$userToken = '';
$clientResponse = $client->sendRequest(new RecaptchaVerificationRequest(userToken: $userToken));

if ($clientResponse->success) {
    // the challenge has passed.
} else {
    // the challenge has failed.
}
```

### Symfony Validator

```php
use SensitiveParameter;
use Sunrise\Recaptcha\Integration\Validator\Constraint\RecaptchaChallenge;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class UserLoginRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        #[SensitiveParameter]
        public string $email,
        #[Assert\NotBlank]
        #[SensitiveParameter]
        public string $password,
        #[Assert\NotBlank(message: RecaptchaChallenge::DEFAULT_ERROR_MESSAGE)]
        #[RecaptchaChallenge]
        #[SensitiveParameter]
        public string $recaptcha,
    ) {
    }
}
```

### PHP-DI definitions

```php
use DI\ContainerBuilder;
use Sunrise\Recaptcha\RecaptchaVerificationClientInterface;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinition(__DIR__ . '/../vendor/sunrise/recaptcha/resources/definitions/recaptcha_verification.php');

// If Symfony Validator is used
$containerBuilder->addDefinition(__DIR__ . '/../vendor/sunrise/recaptcha/resources/definitions/integration/validator/constraint/recaptcha_challenge_validator.php');

$container = $containerBuilder->build();

// See above for usage examples.
$recaptchaClient = $container->get(RecaptchaVerificationClientInterface::class);
```

## Tests

```bash
composer test
```
