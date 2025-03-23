<?php

declare(strict_types=1);

use Sunrise\Recaptcha\Dictionary\ErrorMessage;

return [
    ErrorMessage::CHALLENGE_FAILED => 'Είσαι σίγουρος ότι δεν είσαι ρομπότ;',
    ErrorMessage::MISSING_OR_EMPTY_HEADER => 'Η κεφαλίδα αιτήματος "{{ header_name }}" λείπει ή είναι κενή.',
];
