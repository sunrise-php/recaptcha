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

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Sunrise\Coder\CodecManagerInterface;
use Sunrise\Coder\Dictionary\MediaType;
use Sunrise\Hydrator\Exception\InvalidDataException;
use Sunrise\Hydrator\HydratorInterface;
use Sunrise\Recaptcha\Dto\RecaptchaVerifyRequest;
use Sunrise\Recaptcha\Dto\RecaptchaVerifyResponse;
use Sunrise\Recaptcha\Exception\RecaptchaException;

use function sprintf;

final readonly class RecaptchaClient implements RecaptchaClientInterface
{
    private const HTTP_VERIFY_REQUEST_METHOD = 'POST';
    private const HTTP_VERIFY_REQUEST_URI = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * @var array<string, string>
     */
    private const VERIFICATION_ERROR_MESSAGES = [
        'missing-input-secret' => 'The secret parameter is missing.',
        'invalid-input-secret' => 'The secret parameter is invalid or malformed.',
        'bad-request' => 'The request is invalid or malformed.',
    ];

    public function __construct(
        private RecaptchaConfigurationInterface $recaptchaConfiguration,
        private RequestFactoryInterface $httpRequestFactory,
        private ClientInterface $httpClient,
        private CodecManagerInterface $codecManager,
        private HydratorInterface $hydrator,
        /** @var array<array-key, mixed> */
        private array $codecContext = [],
        /** @var array<string, mixed> */
        private array $hydratorContext = [],
    ) {
    }

    /**
     * @throws ClientExceptionInterface
     * @throws RecaptchaException
     */
    public function sendVerifyRequest(RecaptchaVerifyRequest $clientRequest): RecaptchaVerifyResponse
    {
        $httpRequest = $this->httpRequestFactory
            ->createRequest(self::HTTP_VERIFY_REQUEST_METHOD, self::HTTP_VERIFY_REQUEST_URI)
            ->withHeader('Accept', MediaType::JSON->value)
            ->withHeader('Content-Type', MediaType::UrlEncoded->value);

        $httpRequest->getBody()->write(
            $this->codecManager->encode(MediaType::UrlEncoded, [
                'secret' => $this->recaptchaConfiguration->getPrivateKey(),
                'response' => $clientRequest->token,
            ], $this->codecContext)
        );

        $httpResponse = $this->httpClient->sendRequest($httpRequest);

        try {
            $clientResponse = $this->hydrator->hydrateWithJson(
                RecaptchaVerifyResponse::class,
                (string) $httpResponse->getBody(),
                context: $this->hydratorContext,
            );
        } catch (InvalidDataException $e) {
            throw new RecaptchaException(
                'Unexpected response received from Google reCAPTCHA.',
                previous: $e,
            );
        }

        foreach ($clientResponse->errorCodes as $errorCode) {
            if (isset(self::VERIFICATION_ERROR_MESSAGES[$errorCode])) {
                throw new RecaptchaException(sprintf(
                    'Google reCAPTCHA verification failed: %s',
                    self::VERIFICATION_ERROR_MESSAGES[$errorCode],
                ));
            }
        }

        return $clientResponse;
    }
}
