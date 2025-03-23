<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Êtes-vous certain de ne pas être un robot ?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'L\'en-tête de demande "{{ header_name }}" est manquant ou vide.',
];
