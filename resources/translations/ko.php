<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => '정말 로봇이 아니신가요?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => '요청 헤더 "{{ header_name }}"가 누락되었거나 비어 있습니다.',
];
