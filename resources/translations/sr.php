<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Да ли сте сигурни да нисте робот?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Заглавље захтева "{{ header_name }}" недостаје или је празно.',
];
