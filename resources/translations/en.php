<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Are you sure you are not a robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'The request header "{{ header_name }}" is missing or empty.',
];
