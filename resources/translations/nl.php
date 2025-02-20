<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Weet je zeker dat je geen robot bent?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'De aanvraagheader "{{ header_name }}" ontbreekt of is leeg.',
];
