<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Ste si istí, že nie ste robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Hlavička požiadavky "{{ header_name }}" chýba alebo je prázdna.',
];
