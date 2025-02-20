<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Bist du sicher, dass du kein Roboter bist?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Der Anfrage-Header "{{ header_name }}" fehlt oder ist leer.',
];
