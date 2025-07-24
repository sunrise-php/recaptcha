<?php

declare(strict_types=1);

namespace Sunrise\Recaptcha\Tests\Integration\Validator\Constraint;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Sunrise\Recaptcha\Dto\RecaptchaVerificationRequest;
use Sunrise\Recaptcha\Dto\RecaptchaVerificationResponse;
use Sunrise\Recaptcha\Integration\Validator\Constraint\RecaptchaChallenge;
use Sunrise\Recaptcha\Integration\Validator\Constraint\RecaptchaChallengeValidator;
use Sunrise\Recaptcha\RecaptchaVerificationClientInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

final class RecaptchaChallengeValidatorTest extends TestCase
{
    private RecaptchaVerificationClientInterface&MockObject $mockedVerificationClient;
    private ExecutionContextInterface&MockObject $mockedExecutionContext;
    private ConstraintViolationBuilderInterface&MockObject $mockedConstraintViolationBuilder;

    protected function setUp(): void
    {
        $this->mockedVerificationClient = $this->createMock(RecaptchaVerificationClientInterface::class);
        $this->mockedExecutionContext = $this->createMock(ExecutionContextInterface::class);
        $this->mockedConstraintViolationBuilder = $this->createMock(ConstraintViolationBuilderInterface::class);
    }

    private function createRecaptchaChallengeValidator(): RecaptchaChallengeValidator
    {
        return new RecaptchaChallengeValidator(
            verificationClient: $this->mockedVerificationClient,
        );
    }

    public function testUnexpectedConstraint(): void
    {
        $constraint = $this->createMock(Constraint::class);
        $validator = $this->createRecaptchaChallengeValidator();
        $this->expectException(UnexpectedTypeException::class);
        $validator->validate(null, $constraint);
    }

    public function testNullValue(): void
    {
        $this->mockedExecutionContext->expects($this->never())->method('buildViolation');
        $this->createRecaptchaChallengeValidator()->validate(null, new RecaptchaChallenge());
    }

    public function testEmptyValue(): void
    {
        $this->mockedExecutionContext->expects($this->never())->method('buildViolation');
        $this->createRecaptchaChallengeValidator()->validate('', new RecaptchaChallenge());
    }

    public function testUnexpectedValue(): void
    {
        $constraint = new RecaptchaChallenge();
        $validator = $this->createRecaptchaChallengeValidator();
        $this->expectException(UnexpectedValueException::class);
        $validator->validate([], $constraint);
    }

    public function testChallengePassed(): void
    {
        $this->mockedVerificationClient->expects($this->once())->method('sendRequest')->with(self::callback(fn(RecaptchaVerificationRequest $clientRequest) => $clientRequest->userToken === 'foo'))->willReturn(new RecaptchaVerificationResponse(success: true));
        $this->mockedExecutionContext->expects($this->never())->method('buildViolation');
        $this->createRecaptchaChallengeValidator()->validate('foo', new RecaptchaChallenge());
    }

    public function testChallengeFailed(): void
    {
        $this->mockedVerificationClient->expects($this->once())->method('sendRequest')->with(self::callback(fn(RecaptchaVerificationRequest $clientRequest) => $clientRequest->userToken === 'foo'))->willReturn(new RecaptchaVerificationResponse(success: false));
        $this->mockedExecutionContext->expects($this->once())->method('buildViolation')->with(RecaptchaChallenge::DEFAULT_ERROR_MESSAGE)->willReturn($this->mockedConstraintViolationBuilder);
        $this->mockedExecutionContext->expects($this->once())->method('getPropertyPath')->willReturn('recaptcha');
        $this->mockedConstraintViolationBuilder->expects($this->once())->method('atPath')->with('recaptcha')->willReturnSelf();
        $this->mockedConstraintViolationBuilder->expects($this->once())->method('setCode')->with(RecaptchaChallenge::ERROR_CODE)->willReturnSelf();
        $this->mockedConstraintViolationBuilder->expects($this->once())->method('addViolation');
        $validator = $this->createRecaptchaChallengeValidator();
        $validator->initialize($this->mockedExecutionContext);
        $validator->validate('foo', new RecaptchaChallenge());
    }

    public function testCustomErrorMessage(): void
    {
        $this->mockedVerificationClient->expects($this->once())->method('sendRequest')->with(self::callback(fn(RecaptchaVerificationRequest $clientRequest) => $clientRequest->userToken === 'foo'))->willReturn(new RecaptchaVerificationResponse(success: false));
        $this->mockedExecutionContext->expects($this->once())->method('buildViolation')->with('message')->willReturn($this->mockedConstraintViolationBuilder);
        $this->mockedExecutionContext->expects($this->once())->method('getPropertyPath')->willReturn('recaptcha');
        $this->mockedConstraintViolationBuilder->expects($this->once())->method('atPath')->with('recaptcha')->willReturnSelf();
        $this->mockedConstraintViolationBuilder->expects($this->once())->method('setCode')->with(RecaptchaChallenge::ERROR_CODE)->willReturnSelf();
        $this->mockedConstraintViolationBuilder->expects($this->once())->method('addViolation');
        $validator = $this->createRecaptchaChallengeValidator();
        $validator->initialize($this->mockedExecutionContext);
        $validator->validate('foo', new RecaptchaChallenge(errorMessage: 'message'));
    }
}
