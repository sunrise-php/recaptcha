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

namespace Sunrise\Recaptcha\Integration\Router\Middleware;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sunrise\Http\Router\Dictionary\PlaceholderCode;
use Sunrise\Http\Router\Exception\HttpException;
use Sunrise\Recaptcha\Dictionary\ErrorMessage;
use Sunrise\Recaptcha\Dto\RecaptchaVerificationRequest;
use Sunrise\Recaptcha\RecaptchaVerificationClientInterface;

final readonly class RecaptchaChallengeMiddleware implements MiddlewareInterface
{
    public const DEFAULT_TOKEN_HEADER_NAME = 'X-Recaptcha-Token';
    public const DEFAULT_EMPTY_TOKEN_STATUS_CODE = StatusCodeInterface::STATUS_BAD_REQUEST;
    public const DEFAULT_EMPTY_TOKEN_MESSAGE = ErrorMessage::MISSING_OR_EMPTY_HEADER;
    public const DEFAULT_CHALLENGE_FAILED_STATUS_CODE = StatusCodeInterface::STATUS_FORBIDDEN;
    public const DEFAULT_CHALLENGE_FAILED_MESSAGE = ErrorMessage::CHALLENGE_FAILED;

    public function __construct(
        private RecaptchaVerificationClientInterface $verificationClient,
        private ?string $tokenHeaderName = null,
        private ?int $emptyTokenStatusCode = null,
        private ?string $emptyTokenMessage = null,
        private ?int $challengeFailedStatusCode = null,
        private ?string $challengeFailedMessage = null,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $tokenHeaderName = $this->tokenHeaderName ?? self::DEFAULT_TOKEN_HEADER_NAME;
        $token = $request->getHeaderLine($tokenHeaderName);
        if ($token === '') {
            $emptyTokenStatusCode = $this->emptyTokenStatusCode ?? self::DEFAULT_EMPTY_TOKEN_STATUS_CODE;
            $emptyTokenMessage = $this->emptyTokenMessage ?? self::DEFAULT_EMPTY_TOKEN_MESSAGE;
            throw (new HttpException($emptyTokenMessage, $emptyTokenStatusCode))
                ->addMessagePlaceholder(PlaceholderCode::HEADER_NAME, $tokenHeaderName);
        }

        $recaptchaRequest = new RecaptchaVerificationRequest(userToken: $token);
        $recaptchaResponse = $this->verificationClient->sendRequest($recaptchaRequest);
        if (!$recaptchaResponse->success) {
            $challengeFailedStatusCode = $this->challengeFailedStatusCode ?? self::DEFAULT_CHALLENGE_FAILED_STATUS_CODE;
            $challengeFailedMessage = $this->challengeFailedMessage ?? self::DEFAULT_CHALLENGE_FAILED_MESSAGE;
            throw new HttpException($challengeFailedMessage, $challengeFailedStatusCode);
        }

        return $handler->handle($request);
    }
}
