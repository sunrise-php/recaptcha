<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'هل أنت متأكد أنك لست روبوتاً؟',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'رأس الطلب "{{ header_name }}" مفقود أو فارغ.',
];
