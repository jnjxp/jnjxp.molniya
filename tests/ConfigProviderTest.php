<?php

declare(strict_types=1);

namespace Jnjxp\Molniya;

use PHPUnit\Framework\TestCase;
use Jnjxp\Molniya\ConfigProvider;

class ConfigProviderTest extends TestCase
{
    public function setUp() : void
    {
        $this->provider = new ConfigProvider();
    }

    public function testInvocationReturnsArray()
    {
        $config = ($this->provider)();
        $this->assertIsArray($config);
        return $config;
    }

    /**
     * @depends testInvocationReturnsArray
     */
    public function testReturnedArrayContainsDependencies(array $config)
    {
        $this->assertArrayHasKey('dependencies', $config);
        $this->assertIsArray($config['dependencies']);
    }
}
