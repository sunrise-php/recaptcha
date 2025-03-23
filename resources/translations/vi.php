<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Bạn chắc chắn là bạn không phải là một con robot chứ?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Yêu cầu tiêu đề "{{ header_name }}" bị thiếu hoặc trống.',
];
