<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Biztos vagy abban, hogy nem vagy robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'A(z) "{{ header_name }}" kérésfejléc hiányzik vagy üres.',
];
