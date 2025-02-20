<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Ste prepričani, da niste robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Zahtevani naslov "{{ header_name }}" manjka ali je prazen.',
];
