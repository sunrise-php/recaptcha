<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'നിങ്കളുടെയുണ്ടായ ഒരു റോബോട്ടല്ലേയെന്ന് നിങ്ങള്‍ ഖചിതമാണോ?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'അഭ്യര്‍ത്ഥന ഹെഡ്‌ഡര്‍ "{{ header_name }}" നിരവധിക്കുന്നു അല്ലെങ്കിൽ ശൂന്യമാണ്.',
];
