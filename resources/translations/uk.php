<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Ви впевнені, що ви не робот?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Відсутній або порожній заголовок запиту "{{ header_name }}".',
];
