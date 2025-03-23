<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Da li ste sigurni da niste robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Zaglavlje zahteva "{{ header_name }}" nedostaje ili je prazno.',
];
