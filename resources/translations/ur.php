<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'کیا آپ یقینی ہیں کہ آپ روبوٹ نہیں ہیں؟',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'درخواست ہیڈر "{{ header_name }}" غائب یا خالی ہے۔',
];
