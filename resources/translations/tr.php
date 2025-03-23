<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Emin misin bir robot değil misin?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'İstek başlığı "{{ header_name }}" eksik veya boş.',
];
