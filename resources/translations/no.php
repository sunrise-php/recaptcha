<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Er du sikker på at du ikke er en robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Forespørselsheaderen "{{ header_name }}" mangler eller er tom.',
];
