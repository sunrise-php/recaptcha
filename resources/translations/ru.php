<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Вы уверены, что вы не робот?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Заголовок запроса "{{ header_name }}" отсутствует или пустой.',
];
