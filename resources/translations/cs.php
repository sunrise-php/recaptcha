<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Jste si jisti, že nejste robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Chybí nebo je prázdný záhlaví požadavku "{{ header_name }}".',
];
