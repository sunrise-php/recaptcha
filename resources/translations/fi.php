<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Oletko varma, että et ole robotti?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Pyyntöotsikko "{{ header_name }}" puuttuu tai on tyhjä.',
];
