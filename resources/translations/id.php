<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Apakah Anda yakin Anda bukan robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => '"{{ header_name }}" kehilangan atau kosong permintaan header.',
];
