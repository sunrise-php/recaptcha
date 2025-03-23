<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'আপনি নিশ্চিত না আপনি কোন রোবট?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'অনুরোধ হেডার "{{ header_name }}" অনুরোধ করা বা খালি আছেনি।',
];
