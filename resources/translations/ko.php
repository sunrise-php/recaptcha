<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => '당신이 로봇이 아님을 확신합니까?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => '요청 헤더 "{{ header_name }}"가 없거나 비어 있습니다.',
];
