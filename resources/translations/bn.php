<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'আপনি কি নিশ্চিত যে আপনি রোবট নন?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Запрос заголовка "{{ header_name }}" отсутствует или пуст.',
];
