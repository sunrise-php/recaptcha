<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'तुम्ही खुपच खात्री आहात की तुम्ही रोबोट नाहीत का?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'कृपया अनुरोध शीर्षक "{{ header_name }}" गुम है कि रिक्त है.',
];
