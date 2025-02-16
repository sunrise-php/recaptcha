<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Integration\Validator\Constraint\RecaptchaChallengeValidator;
use Sunrise\Recaptcha\RecaptchaClientInterface;

use function DI\create;
use function DI\get;

return [
    RecaptchaChallengeValidator::class => create()
        ->constructor(
            recaptchaClient: get(RecaptchaClientInterface::class),
        ),
];
