<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => '你确定你不是一个机器人吗？',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => '请求头"{{ header_name }}"丢失或为空。',
];
