<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Estàs segur que no ets un robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'La capçalera de la sol·licitud "{{ header_name }}" falta o està buida.',
];
