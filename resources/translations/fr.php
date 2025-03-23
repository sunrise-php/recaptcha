<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Êtes-vous sûr de ne pas être un robot ?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'L\'en-tête de requête "{{ header_name }}" est manquant ou vide.',
];
