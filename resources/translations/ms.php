<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Adakah anda pasti bahawa anda bukan robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Header permintaan "{{ header_name }}" hilang atau kosong.',
];
