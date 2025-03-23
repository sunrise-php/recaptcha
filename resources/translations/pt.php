<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Você tem certeza de que não é um robô?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'O cabeçalho da solicitação "{{ header_name }}" está ausente ou vazio.',
];
