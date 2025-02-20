<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'คุณแน่ใจหรือว่าคุณไม่ใช่โรบอท?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'ส่วนหัวของคำขอ "{{ header_name }}" หายไปหรือว่างเปล่า.',
];
