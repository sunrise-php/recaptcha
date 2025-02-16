<?php

declare(strict_types=1);

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Sunrise\Coder\CodecManagerInterface;
use Sunrise\Hydrator\HydratorInterface;
use Sunrise\Recaptcha\RecaptchaClient;
use Sunrise\Recaptcha\RecaptchaClientInterface;
use Sunrise\Recaptcha\RecaptchaConfiguration;
use Sunrise\Recaptcha\RecaptchaConfigurationInterface;

use function DI\create;
use function DI\env;
use function DI\get;

return [
    'recaptcha.private_key' => env('RECAPTCHA_PRIVATE_KEY'),
    'recaptcha.codec_context' => [],
    'recaptcha.hydrator_context' => [],

    RecaptchaConfigurationInterface::class => create(RecaptchaConfiguration::class)
        ->constructor(
            privateKey: get('recaptcha.private_key'),
        ),

    RecaptchaClientInterface::class => create(RecaptchaClient::class)
        ->constructor(
            recaptchaConfiguration: get(RecaptchaConfigurationInterface::class),
            httpRequestFactory: get(RequestFactoryInterface::class),
            httpClient: get(ClientInterface::class),
            codecManager: get(CodecManagerInterface::class),
            hydrator: get(HydratorInterface::class),
            codecContext: get('recaptcha.codec_context'),
            hydratorContext: get('recaptcha.hydrator_context'),
        ),
];
