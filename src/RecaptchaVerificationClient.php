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
use Sunrise\Recaptcha\Dto\RecaptchaVerificationRequest;
use Sunrise\Recaptcha\Dto\RecaptchaVerificationResponse;
use Sunrise\Recaptcha\Exception\RecaptchaException;

use function sprintf;

final readonly class RecaptchaVerificationClient implements RecaptchaVerificationClientInterface
{
    /**
     * @var array<string, string>
     */
    private const ERROR_MESSAGES = [
        'bad-request' => 'The request is invalid or malformed.',
        'invalid-input-secret' => 'The secret parameter is invalid or malformed.',
        'missing-input-secret' => 'The secret parameter is missing.',
    ];

    public function __construct(
        private RecaptchaVerificationConfigurationInterface $verificationConfiguration,
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
    public function sendRequest(RecaptchaVerificationRequest $clientRequest): RecaptchaVerificationResponse
    {
        $httpRequest = $this->httpRequestFactory
            ->createRequest('POST', 'https://www.google.com/recaptcha/api/siteverify')
            ->withHeader('Accept', MediaType::JSON->value)
            ->withHeader('Content-Type', MediaType::UrlEncoded->value);

        $httpRequest->getBody()->write(
            $this->codecManager->encode(MediaType::UrlEncoded, [
                'secret' => $this->verificationConfiguration->getPrivateKey(),
                'response' => $clientRequest->userToken,
            ], $this->codecContext)
        );

        $httpResponse = $this->httpClient->sendRequest($httpRequest);

        try {
            $clientResponse = $this->hydrator->hydrateWithJson(
                RecaptchaVerificationResponse::class,
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
            if (isset(self::ERROR_MESSAGES[$errorCode])) {
                throw new RecaptchaException(sprintf(
                    'Google reCAPTCHA verification failed: %s',
                    self::ERROR_MESSAGES[$errorCode],
                ));
            }
        }

        return $clientResponse;
    }
}
