<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'К сожалению, я не могу выполнить ваш запрос. "ML" не является стандартным языковым кодом. Можете уточнить, какой язык вы имели в виду?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Запросний заголовок "{{ header_name }}" відсутній або порожній.',
];
