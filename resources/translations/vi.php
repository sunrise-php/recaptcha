<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Bạn có chắc là bạn không phải là một robot không?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Заголовок запроса "{{ header_name }}" отсутствует или пустой.',
];
