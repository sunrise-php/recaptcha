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

use SensitiveParameter;
use Sunrise\Recaptcha\Dto\RecaptchaVerificationRequest;
use Sunrise\Recaptcha\RecaptchaVerificationClientInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

use function is_string;

final class RecaptchaChallengeValidator extends ConstraintValidator
{
    public function __construct(
        private readonly RecaptchaVerificationClientInterface $verificationClient,
    ) {
    }

    public function validate(#[SensitiveParameter] mixed $value, Constraint $constraint): void
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

        $clientResponse = $this->verificationClient->sendRequest(
            new RecaptchaVerificationRequest(userToken: $value)
        );

        if ($clientResponse->success) {
            return;
        }

        $this->context->buildViolation($constraint->errorMessage ?? RecaptchaChallenge::DEFAULT_ERROR_MESSAGE)
            ->atPath($constraint->errorPath ?? $this->context->getPropertyPath())
            ->setCode(RecaptchaChallenge::ERROR_CODE)
            ->addViolation();
    }
}
