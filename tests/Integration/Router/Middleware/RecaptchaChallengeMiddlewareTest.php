<?php

declare(strict_types=1);

namespace Sunrise\Recaptcha\Tests\Integration\Router\Middleware;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sunrise\Http\Router\Exception\HttpException;
use Sunrise\Recaptcha\Dto\RecaptchaVerificationRequest;
use Sunrise\Recaptcha\Dto\RecaptchaVerificationResponse;
use Sunrise\Recaptcha\Integration\Router\Middleware\RecaptchaChallengeMiddleware;
use Sunrise\Recaptcha\RecaptchaVerificationClientInterface;

final class RecaptchaChallengeMiddlewareTest extends TestCase
{
    private RecaptchaVerificationClientInterface&MockObject $mockedVerificationClient;
    private ServerRequestInterface&MockObject $mockedHttpRequest;
    private RequestHandlerInterface&MockObject $mockedHttpRequestHandler;
    private ResponseInterface&MockObject $mockedHttpResponse;

    protected function setUp(): void
    {
        $this->mockedVerificationClient = $this->createMock(RecaptchaVerificationClientInterface::class);
        $this->mockedHttpRequest = $this->createMock(ServerRequestInterface::class);
        $this->mockedHttpRequestHandler = $this->createMock(RequestHandlerInterface::class);
        $this->mockedHttpResponse = $this->createMock(ResponseInterface::class);
    }

    private function createRecaptchaChallengeMiddleware(
        ?string $tokenHeaderName = null,
        ?int $emptyTokenStatusCode = null,
        ?string $emptyTokenMessage = null,
        ?int $challengeFailedStatusCode = null,
        ?string $challengeFailedMessage = null,
    ): RecaptchaChallengeMiddleware {
        return new RecaptchaChallengeMiddleware(
            verificationClient: $this->mockedVerificationClient,
            tokenHeaderName: $tokenHeaderName,
            emptyTokenStatusCode: $emptyTokenStatusCode,
            emptyTokenMessage: $emptyTokenMessage,
            challengeFailedStatusCode: $challengeFailedStatusCode,
            challengeFailedMessage: $challengeFailedMessage,
        );
    }

    public function testEmptyToken(): void
    {
        $this->mockedHttpRequest->expects($this->once())->method('getHeaderLine')->with('X-Recaptcha-Token')->willReturn('');
        $this->mockedVerificationClient->expects($this->never())->method('sendRequest');
        $this->mockedHttpRequestHandler->expects($this->never())->method('handle');
        $middleware = $this->createRecaptchaChallengeMiddleware();
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('The request header "X-Recaptcha-Token" is missing or empty.');

        try {
            $middleware->process($this->mockedHttpRequest, $this->mockedHttpRequestHandler);
        } catch (HttpException $e) {
            self::assertSame(400, $e->getCode());
            throw $e;
        }
    }

    public function testChallengeFailed(): void
    {
        $this->mockedHttpRequest->expects($this->once())->method('getHeaderLine')->with('X-Recaptcha-Token')->willReturn('foo');
        $this->mockedVerificationClient->expects($this->once())->method('sendRequest')->with(self::callback(fn(RecaptchaVerificationRequest $clientRequest) => $clientRequest->userToken === 'foo'))->willReturn(new RecaptchaVerificationResponse(success: false));
        $this->mockedHttpRequestHandler->expects($this->never())->method('handle');
        $middleware = $this->createRecaptchaChallengeMiddleware();
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Are you sure you are not a robot?');

        try {
            $middleware->process($this->mockedHttpRequest, $this->mockedHttpRequestHandler);
        } catch (HttpException $e) {
            self::assertSame(403, $e->getCode());
            throw $e;
        }
    }

    public function testChallengePassed(): void
    {
        $this->mockedHttpRequest->expects($this->once())->method('getHeaderLine')->with('X-Recaptcha-Token')->willReturn('foo');
        $this->mockedVerificationClient->expects($this->once())->method('sendRequest')->with(self::callback(fn(RecaptchaVerificationRequest $clientRequest) => $clientRequest->userToken === 'foo'))->willReturn(new RecaptchaVerificationResponse(success: true));
        $this->mockedHttpRequestHandler->expects($this->once())->method('handle')->with($this->mockedHttpRequest)->willReturn($this->mockedHttpResponse);
        self::assertSame($this->mockedHttpResponse, $this->createRecaptchaChallengeMiddleware()->process($this->mockedHttpRequest, $this->mockedHttpRequestHandler));
    }

    public function testCustomTokenHeaderName(): void
    {
        $this->mockedHttpRequest->expects($this->once())->method('getHeaderLine')->with('X-Foo')->willReturn('foo');
        $this->mockedVerificationClient->expects($this->once())->method('sendRequest')->with(self::callback(fn(RecaptchaVerificationRequest $clientRequest) => $clientRequest->userToken === 'foo'))->willReturn(new RecaptchaVerificationResponse(success: true));
        $this->mockedHttpRequestHandler->expects($this->once())->method('handle')->with($this->mockedHttpRequest)->willReturn($this->mockedHttpResponse);
        self::assertSame($this->mockedHttpResponse, $this->createRecaptchaChallengeMiddleware(tokenHeaderName: 'X-Foo')->process($this->mockedHttpRequest, $this->mockedHttpRequestHandler));
    }

    public function testCustomEmptyTokenStatusCode(): void
    {
        $this->mockedHttpRequest->expects($this->once())->method('getHeaderLine')->with('X-Recaptcha-Token')->willReturn('');
        $this->mockedVerificationClient->expects($this->never())->method('sendRequest');
        $this->mockedHttpRequestHandler->expects($this->never())->method('handle');
        $middleware = $this->createRecaptchaChallengeMiddleware(emptyTokenStatusCode: 500);
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('The request header "X-Recaptcha-Token" is missing or empty.');

        try {
            $middleware->process($this->mockedHttpRequest, $this->mockedHttpRequestHandler);
        } catch (HttpException $e) {
            self::assertSame(500, $e->getCode());
            throw $e;
        }
    }

    public function testCustomEmptyTokenMessage(): void
    {
        $this->mockedHttpRequest->expects($this->once())->method('getHeaderLine')->with('X-Recaptcha-Token')->willReturn('');
        $this->mockedVerificationClient->expects($this->never())->method('sendRequest');
        $this->mockedHttpRequestHandler->expects($this->never())->method('handle');
        $middleware = $this->createRecaptchaChallengeMiddleware(emptyTokenMessage: 'foo');
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('foo');
        $middleware->process($this->mockedHttpRequest, $this->mockedHttpRequestHandler);
    }

    public function testCustomChallengeFailedStatusCode(): void
    {
        $this->mockedHttpRequest->expects($this->once())->method('getHeaderLine')->with('X-Recaptcha-Token')->willReturn('foo');
        $this->mockedVerificationClient->expects($this->once())->method('sendRequest')->with(self::callback(fn(RecaptchaVerificationRequest $clientRequest) => $clientRequest->userToken === 'foo'))->willReturn(new RecaptchaVerificationResponse(success: false));
        $this->mockedHttpRequestHandler->expects($this->never())->method('handle');
        $middleware = $this->createRecaptchaChallengeMiddleware(challengeFailedStatusCode: 500);
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('Are you sure you are not a robot?');

        try {
            $middleware->process($this->mockedHttpRequest, $this->mockedHttpRequestHandler);
        } catch (HttpException $e) {
            self::assertSame(500, $e->getCode());
            throw $e;
        }
    }

    public function testCustomChallengeFailedMessage(): void
    {
        $this->mockedHttpRequest->expects($this->once())->method('getHeaderLine')->with('X-Recaptcha-Token')->willReturn('foo');
        $this->mockedVerificationClient->expects($this->once())->method('sendRequest')->with(self::callback(fn(RecaptchaVerificationRequest $clientRequest) => $clientRequest->userToken === 'foo'))->willReturn(new RecaptchaVerificationResponse(success: false));
        $this->mockedHttpRequestHandler->expects($this->never())->method('handle');
        $middleware = $this->createRecaptchaChallengeMiddleware(challengeFailedMessage: 'foo');
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('foo');
        $middleware->process($this->mockedHttpRequest, $this->mockedHttpRequestHandler);
    }
}
