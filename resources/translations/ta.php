<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'உறுதியாக நீ ஒரு காலனாயும் என்று நீங்கள் உறுதிசெய்கிறீர்களா?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'கோரிக்கை தலைப்பை "{{ header_name }}" வரைய அல்லது காலியாக இருக்கவில்லை.',
];
