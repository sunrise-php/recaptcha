<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Bạn có chắc rằng bạn không phải là robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Tiêu đề yêu cầu "{{ header_name }}" bị thiếu hoặc trống.',
];
