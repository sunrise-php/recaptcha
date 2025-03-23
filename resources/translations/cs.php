<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Jste si jistí, že nejste robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'V požadavku chybí nebo je prázdná hlavička "{{ header_name }}".',
];
