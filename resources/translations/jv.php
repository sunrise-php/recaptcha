<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Apa sampeyan yakin sampeyan dudu robot?',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Header permintaan "{{ header_name }}" hilang utawa kosong.',
];
