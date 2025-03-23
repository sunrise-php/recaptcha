<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Si si iste que non es un robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Chýba alebo je prázdna hlavička požiadavky "{{ header_name }}".',
];
