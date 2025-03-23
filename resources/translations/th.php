<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'คุณแน่ใจหรือว่าคุณไม่ใช่หุ่นยนต์?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Заголовок запроса "{{ header_name }}" отсутствует или пуст.',
];
