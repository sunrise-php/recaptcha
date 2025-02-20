<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Сигурни ли сте, че не сте робот?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Заглавката на заявката "{{ header_name }}" липсва или е празна.',
];
