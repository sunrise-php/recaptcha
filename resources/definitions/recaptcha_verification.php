<?php

declare(strict_types=1);

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Sunrise\Coder\CodecManagerInterface;
use Sunrise\Hydrator\HydratorInterface;
use Sunrise\Recaptcha\RecaptchaVerificationClient;
use Sunrise\Recaptcha\RecaptchaVerificationClientInterface;
use Sunrise\Recaptcha\RecaptchaVerificationConfiguration;
use Sunrise\Recaptcha\RecaptchaVerificationConfigurationInterface;

use function DI\create;
use function DI\env;
use function DI\get;

return [
    'recaptcha.verification.private_key' => env('RECAPTCHA_VERIFICATION_PRIVATE_KEY'),
    'recaptcha.verification.bypass_tokens' => [],
    'recaptcha.verification.codec_context' => [],
    'recaptcha.verification.hydrator_context' => [],

    RecaptchaVerificationConfigurationInterface::class => create(RecaptchaVerificationConfiguration::class)
        ->constructor(
            privateKey: get('recaptcha.verification.private_key'),
            bypassTokens: get('recaptcha.verification.bypass_tokens'),
        ),

    RecaptchaVerificationClientInterface::class => create(RecaptchaVerificationClient::class)
        ->constructor(
            verificationConfiguration: get(RecaptchaVerificationConfigurationInterface::class),
            httpRequestFactory: get(RequestFactoryInterface::class),
            httpClient: get(ClientInterface::class),
            codecManager: get(CodecManagerInterface::class),
            hydrator: get(HydratorInterface::class),
            codecContext: get('recaptcha.verification.codec_context'),
            hydratorContext: get('recaptcha.verification.hydrator_context'),
        ),
];
