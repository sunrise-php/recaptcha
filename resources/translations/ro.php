<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Ești sigur că nu ești un robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Antetul cererii "{{ header_name }}" lipsește sau este gol.',
];
