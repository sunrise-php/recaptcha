<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'あなたはロボットではないと確信していますか？',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'リクエストヘッダー "{{ header_name }}" が存在しないか、空です.',
];
