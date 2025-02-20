<?php

/**
 * It's free open-source software released under the MIT License.
 *
 * @author Anatoly Nekhay <afenric@gmail.com>
 * @copyright Copyright (c) 2025, Anatoly Nekhay
 * @license https://github.com/sunrise-php/recaptcha/blob/master/LICENSE
 * @link https://github.com/sunrise-php/recaptcha
 */

declare(strict_types=1);

namespace Sunrise\Recaptcha\Dictionary;

final readonly class ErrorMessage
{
    public const CHALLENGE_FAILED = 'Are you sure you are not a robot?';
    public const MISSING_OR_EMPTY_HEADER = 'The request header "{{ header_name }}" is missing or empty.';
}
