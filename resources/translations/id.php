<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Apakah Anda yakin bahwa Anda bukan robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Header permintaan "{{ header_name }}" tidak ada atau kosong.',
];
