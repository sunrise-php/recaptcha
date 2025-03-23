<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Ты уверен, что ты не робот?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'В заголовке запроса "{{ header_name }}" отсутствует или пуст.',
];
