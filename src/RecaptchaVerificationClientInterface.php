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

namespace Sunrise\Recaptcha;

use Sunrise\Recaptcha\Dto\RecaptchaVerificationRequest;
use Sunrise\Recaptcha\Dto\RecaptchaVerificationResponse;

interface RecaptchaVerificationClientInterface
{
    public function sendRequest(RecaptchaVerificationRequest $clientRequest): RecaptchaVerificationResponse;
}
