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

namespace Sunrise\Recaptcha\Dto;

use Sunrise\Hydrator\Annotation\Alias;
use Sunrise\Hydrator\Annotation\Subtype;
use Sunrise\Hydrator\Dictionary\BuiltinType;

final readonly class RecaptchaVerificationResponse
{
    public function __construct(
        public bool $success,
        /** @var string[] */
        #[Alias('error-codes')]
        #[Subtype(BuiltinType::STRING)]
        public array $errorCodes = [],
    ) {
    }
}
