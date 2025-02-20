<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Jesi li siguran da nisi robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Zaglavlje zahtjeva "{{ header_name }}" nedostaje ili je prazno.',
];
