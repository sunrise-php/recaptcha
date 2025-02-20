<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Sei sicuro di non essere un robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'L'intestazione della richiesta "{{ header_name }}" è mancante o vuota.',
];
