<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Biztos vagy benne, hogy nem vagy robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'A kérelem fejléc "{{ header_name }}" hiányzik vagy üres.',
];
