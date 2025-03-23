<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Biztos vagy benne, hogy nem vagy robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'A "{{ header_name }}" kérés fejléc hiányzik vagy üres.',
];
