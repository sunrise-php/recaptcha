<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Czy jesteś pewien, że nie jesteś robotem?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Nagłówek żądania "{{ header_name }}" jest pusty lub nie został podany.',
];
