<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Jste si jistí, že nejste robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Záhlaví požadavku "{{ header_name }}" chybí nebo je prázdné.',
];
