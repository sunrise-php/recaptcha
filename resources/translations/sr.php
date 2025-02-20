<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Da li si siguran da nisi robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Zaglavlje zahteva "{{ header_name }}" nedostaje ili je prazno.',
];
