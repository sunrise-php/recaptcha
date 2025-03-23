<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'நீங்கள் ஒரு ரோபோட் அல்லது என்பதில் உறுதியாக உள்ளீர்களா?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Заголовок запроса "{{ header_name }}" отсутствует или пуст.',
];
