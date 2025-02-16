<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Integration\Router\Middleware\RecaptchaChallengeMiddleware;
use Sunrise\Recaptcha\RecaptchaVerificationClientInterface;

use function DI\create;
use function DI\get;

return [
    'router.recaptcha_challenge_middleware.token_header_name' => null,
    'router.recaptcha_challenge_middleware.empty_token_status_code' => null,
    'router.recaptcha_challenge_middleware.empty_token_message' => null,
    'router.recaptcha_challenge_middleware.challenge_failed_status_code' => null,
    'router.recaptcha_challenge_middleware.challenge_failed_message' => null,

    RecaptchaChallengeMiddleware::class => create()
        ->constructor(
            verificationClient: get(RecaptchaVerificationClientInterface::class),
            tokenHeaderName: get('router.recaptcha_challenge_middleware.token_header_name'),
            emptyTokenStatusCode: get('router.recaptcha_challenge_middleware.empty_token_status_code'),
            emptyTokenMessage: get('router.recaptcha_challenge_middleware.empty_token_message'),
            challengeFailedStatusCode: get('router.recaptcha_challenge_middleware.challenge_failed_status_code'),
            challengeFailedMessage: get('router.recaptcha_challenge_middleware.challenge_failed_message'),
        ),
];
