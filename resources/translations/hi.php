<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'क्या आप सुनिश्चित हैं कि आप एक रोबोट नहीं हैं?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'अनुरोध हेडर "{{ header_name }}" गायब या खाली है।',
];
