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

use Sunrise\Recaptcha\Dto\RecaptchaVerifyRequest;
use Sunrise\Recaptcha\RecaptchaClientInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

use function is_string;

final class RecaptchaChallengeValidator extends ConstraintValidator
{
    public function __construct(
        private readonly RecaptchaClientInterface $recaptchaClient,
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (! $constraint instanceof RecaptchaChallenge) {
            throw new UnexpectedTypeException($constraint, RecaptchaChallenge::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        $recaptchaResponse = $this->recaptchaClient->sendVerifyRequest(
            new RecaptchaVerifyRequest(token: $value)
        );

        if ($recaptchaResponse->success) {
            return;
        }

        $this->context->buildViolation($constraint->errorMessage ?? RecaptchaChallenge::DEFAULT_ERROR_MESSAGE)
            ->atPath($constraint->errorPath ?? $this->context->getPropertyPath())
            ->setCode(RecaptchaChallenge::ERROR_CODE)
            ->addViolation();
    }
}
