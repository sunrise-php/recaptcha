<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'మీరు ఖచ్చితంగా రోబోట్ కాదుగా ఉన్నారా?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'అభ్యర్థన శీర్షిక "{{ header_name }}" లేదా ఖాళీ ఉండదు.',
];
