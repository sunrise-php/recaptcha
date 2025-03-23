<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Tem certeza de que não é um robô?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'O cabeçalho de solicitação "{{ header_name }}" está ausente ou vazio.',
];
