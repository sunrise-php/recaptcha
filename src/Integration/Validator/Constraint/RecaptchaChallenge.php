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

namespace Sunrise\Recaptcha\Integration\Validator\Constraint;

use Attribute;
use Sunrise\Recaptcha\Dictionary\ErrorMessage;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class RecaptchaChallenge extends Constraint
{
    public const ERROR_CODE = '43769a51-3d82-4601-8cb1-0056ef5a58e5';
    public const DEFAULT_ERROR_MESSAGE = ErrorMessage::CHALLENGE_FAILED;

    /**
     * @param array<array-key, string>|null $groups
     */
    public function __construct(
        public readonly ?string $errorPath = null,
        public readonly ?string $errorMessage = null,
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct($options, $groups, $payload);
    }
}
