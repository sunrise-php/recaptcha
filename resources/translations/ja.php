<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'ロボットでないことを確認していますか？',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'リクエストヘッダー "{{ header_name }}" が見つかりません、または空です。',
];
