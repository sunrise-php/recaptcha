<?php

declare(strict_types=1);

namespace Sunrise\Recaptcha\Tests;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Sunrise\Coder\CodecManagerInterface;
use Sunrise\Coder\Dictionary\MediaType;
use Sunrise\Hydrator\Exception\InvalidDataException;
use Sunrise\Hydrator\HydratorInterface;
use Sunrise\Recaptcha\Dto\RecaptchaVerificationRequest;
use Sunrise\Recaptcha\Dto\RecaptchaVerificationResponse;
use Sunrise\Recaptcha\Exception\RecaptchaException;
use Sunrise\Recaptcha\RecaptchaVerificationClient;
use Sunrise\Recaptcha\RecaptchaVerificationConfigurationInterface;

use function sprintf;

final class RecaptchaVerificationClientTest extends TestCase
{
    private RecaptchaVerificationConfigurationInterface&MockObject $mockedVerificationConfiguration;
    private RequestFactoryInterface&MockObject $mockedHttpRequestFactory;
    private ClientInterface&MockObject $mockedHttpClient;
    private CodecManagerInterface&MockObject $mockedCodecManager;
    private HydratorInterface&MockObject $mockedHydrator;
    private array $codecContext;
    private array $hydratorContext;
    private RequestInterface&MockObject $mockedHttpRequest;
    private StreamInterface&MockObject $mockedHttpRequestBody;
    private ResponseInterface&MockObject $mockedHttpResponse;
    private StreamInterface&MockObject $mockedHttpResponseBody;
    private string $expectedHttpResponseBodyContents;

    protected function setUp(): void
    {
        $this->initMocks();

        // TODO: the test must be rewritten
        if (!\in_array($this->name(), ['testSendRequestWithBypassToken'], true)) {
            $this->prepareMocks();
        }
    }

    private function initMocks(): void
    {
        $this->mockedVerificationConfiguration = $this->createMock(RecaptchaVerificationConfigurationInterface::class);
        $this->mockedHttpRequestFactory = $this->createMock(RequestFactoryInterface::class);
        $this->mockedHttpClient = $this->createMock(ClientInterface::class);
        $this->mockedCodecManager = $this->createMock(CodecManagerInterface::class);
        $this->mockedHydrator = $this->createMock(HydratorInterface::class);
        $this->codecContext = [];
        $this->hydratorContext = [];
        $this->mockedHttpRequest = $this->createMock(RequestInterface::class);
        $this->mockedHttpRequestBody = $this->createMock(StreamInterface::class);
        $this->mockedHttpResponse = $this->createMock(ResponseInterface::class);
        $this->mockedHttpResponseBody = $this->createMock(StreamInterface::class);
        $this->expectedHttpResponseBodyContents = '';
    }

    private function prepareMocks(): void
    {
        $this->codecContext = ['foo' => 'bar'];
        $this->hydratorContext = ['bar' => 'baz'];

        $this->mockedHttpRequestFactory->expects($this->once())->method('createRequest')->with('POST', 'https://www.google.com/recaptcha/api/siteverify')->willReturn($this->mockedHttpRequest);

        $this->mockedHttpRequest->expects($this->exactly(2))->method('withHeader')->withAnyParameters()->willReturnCallback(function ($name, $value) {
            self::assertContains([$name, $value], [['Accept', 'application/json'], ['Content-Type', 'application/x-www-form-urlencoded']]);
            return $this->mockedHttpRequest;
        });

        $this->mockedHttpRequest->expects($this->once())->method('getBody')->willReturn($this->mockedHttpRequestBody);
        $this->mockedVerificationConfiguration->expects($this->once())->method('getPrivateKey')->willReturn('foo');
        $this->mockedCodecManager->expects($this->once())->method('encode')->with(MediaType::UrlEncoded, ['secret' => 'foo', 'response' => 'bar'], $this->codecContext)->willReturn('secret=foo&response=bar');
        $this->mockedHttpRequestBody->expects($this->once())->method('write')->with('secret=foo&response=bar')->willReturn(23);
        $this->mockedHttpClient->expects($this->once())->method('sendRequest')->with($this->mockedHttpRequest)->willReturn($this->mockedHttpResponse);
        $this->mockedHttpResponse->expects($this->once())->method('getBody')->willReturn($this->mockedHttpResponseBody);
        $this->mockedHttpResponseBody->expects($this->once())->method('__toString')->willReturnCallback(fn() => $this->expectedHttpResponseBodyContents);
    }

    private function createRecaptchaClient(): RecaptchaVerificationClient
    {
        return new RecaptchaVerificationClient(
            verificationConfiguration: $this->mockedVerificationConfiguration,
            httpRequestFactory: $this->mockedHttpRequestFactory,
            httpClient: $this->mockedHttpClient,
            codecManager: $this->mockedCodecManager,
            hydrator: $this->mockedHydrator,
            codecContext: $this->codecContext,
            hydratorContext: $this->hydratorContext,
        );
    }

    public function testSendRequest(): void
    {
        $this->expectedHttpResponseBodyContents = '{"success":true}';
        $clientResponse = new RecaptchaVerificationResponse(success: true);
        $this->mockedHydrator->expects($this->once())->method('hydrateWithJson')->with(RecaptchaVerificationResponse::class, $this->expectedHttpResponseBodyContents, self::anything(), self::anything(), self::anything(), $this->hydratorContext)->willReturn($clientResponse);
        $clientRequest = new RecaptchaVerificationRequest('bar');
        self::assertSame($clientResponse, $this->createRecaptchaClient()->sendRequest($clientRequest));
    }

    public function testSendRequestWithBypassToken(): void
    {
        $this->mockedVerificationConfiguration->expects($this->once())->method('getBypassTokens')->willReturn(['a', 'b', 'c']);
        $this->mockedHttpClient->expects($this->never())->method('sendRequest');
        $this->createRecaptchaClient()->sendRequest(new RecaptchaVerificationRequest('b'));
    }

    public function testUnexpectedHttpResponse(): void
    {
        $this->expectedHttpResponseBodyContents = '{"success":true}';
        $hydrationError = new InvalidDataException('Invalid data.');
        $this->mockedHydrator->expects($this->once())->method('hydrateWithJson')->with(RecaptchaVerificationResponse::class, $this->expectedHttpResponseBodyContents, self::anything(), self::anything(), self::anything(), $this->hydratorContext)->willThrowException($hydrationError);
        $clientRequest = new RecaptchaVerificationRequest('bar');
        $this->expectException(RecaptchaException::class);
        $this->expectExceptionMessage('Unexpected response received from Google reCAPTCHA.');

        try {
            $this->createRecaptchaClient()->sendRequest($clientRequest);
        } catch (RecaptchaException $e) {
            self::assertSame($hydrationError, $e->getPrevious());
            throw $e;
        }
    }

    #[DataProvider('rejectedHttpRequestDataProvider')]
    public function testRejectedHttpRequest(string $errorCode, string $errorMessage): void
    {
        $this->expectedHttpResponseBodyContents = sprintf('{"success":false,"error-codes":["%s"]}', $errorCode);
        $clientResponse = new RecaptchaVerificationResponse(success: false, errorCodes: [$errorCode]);
        $this->mockedHydrator->expects($this->once())->method('hydrateWithJson')->with(RecaptchaVerificationResponse::class, $this->expectedHttpResponseBodyContents, self::anything(), self::anything(), self::anything(), $this->hydratorContext)->willReturn($clientResponse);
        $clientRequest = new RecaptchaVerificationRequest('bar');
        $this->expectException(RecaptchaException::class);
        $this->expectExceptionMessage(sprintf('Google reCAPTCHA verification failed: %s', $errorMessage));
        $this->createRecaptchaClient()->sendRequest($clientRequest);
    }

    public static function rejectedHttpRequestDataProvider(): Generator
    {
        yield ['bad-request', 'The request is invalid or malformed.'];
        yield ['invalid-input-secret', 'The secret parameter is invalid or malformed.'];
        yield ['missing-input-secret', 'The secret parameter is missing.'];
    }
}
