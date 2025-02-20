<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Är du säker på att du inte är en robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Förfrågningshuvudet "{{ header_name }}" saknas eller är tomt.',
];
