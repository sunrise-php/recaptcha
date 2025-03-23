<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Oletko varma ettet ole robotti?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Pyyntöotsake "{{ header_name }}" puuttuu tai on tyhjä.',
];
