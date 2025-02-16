<?php

declare(strict_types=1);

namespace Sunrise\Recaptcha\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use SensitiveParameter;
use Sunrise\Recaptcha\RecaptchaVerificationConfiguration;

final class RecaptchaVerificationConfigurationTest extends TestCase
{
    public function testConstructor(): void
    {
        $configuration = new RecaptchaVerificationConfiguration(privateKey: 'foo');
        self::assertSame('foo', $configuration->getPrivateKey());
    }

    public function testSensitiveParameters(): void
    {
        $parameters = [];
        foreach ((new ReflectionClass(RecaptchaVerificationConfiguration::class))?->getConstructor()->getParameters() ?? [] as $parameter) {
            $parameters[$parameter->name] = $parameter;
        }

        self::assertArrayHasKey('privateKey', $parameters);
        self::assertCount(1, $parameters['privateKey']->getAttributes(SensitiveParameter::class));
    }
}
