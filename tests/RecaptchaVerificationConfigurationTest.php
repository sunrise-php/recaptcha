<?php

declare(strict_types=1);

namespace Sunrise\Recaptcha\Tests;

use PHPUnit\Framework\TestCase;
use Sunrise\Recaptcha\RecaptchaVerificationConfiguration;

final class RecaptchaVerificationConfigurationTest extends TestCase
{
    public function testConstructor(): void
    {
        $configuration = new RecaptchaVerificationConfiguration(privateKey: 'foo');
        self::assertSame('foo', $configuration->getPrivateKey());
    }
}
