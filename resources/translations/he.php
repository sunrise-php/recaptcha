<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'האם אתה בטוח שאינך רובוט?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'כותרת הבקשה "{{ header_name }}" חסרה או ריקה.',
];
