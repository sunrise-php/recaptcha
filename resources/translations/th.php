<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'คุณแน่ใจหรือไม่ว่าคุณไม่ใช่หุ่นยนต์?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'หัวข้อของคำขอ "{{ header_name }}" ได้หายไปหรือว่าว่างเปล่า ',
];
