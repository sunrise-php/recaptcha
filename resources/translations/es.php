<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => '¿Estás seguro de que no eres un robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'El encabezado de la solicitud "{{ header_name }}" falta o está vacío.',
];
