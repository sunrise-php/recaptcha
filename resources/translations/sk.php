<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Si iste veražne nie si robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Chýba hlavička požiadavky "{{ header_name }}" alebo je prázdna.',
];
