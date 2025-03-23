<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => '"ru": Ты точно не робот?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'विनंतीकडून शीर्षलेख "{{ header_name }}" गहाळ किंवा रिकामा आहे.',
];
