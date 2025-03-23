<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Ви впевнені, що не робот?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Заголовок запиту "{{ header_name }}" відсутній або порожній.',
];
