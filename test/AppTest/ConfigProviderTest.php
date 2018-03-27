<?php

namespace AppTest;


use App\ConfigProvider;
use PHPUnit\Framework\TestCase;

class ConfigProviderTest extends TestCase
{
    private $provider;

    public function setUp()
    {
        $this->provider = new ConfigProvider();
    }

    public function testInvocationReturnsArray()
    {
        $config = ($this->provider)();
        $this->assertInternalType('array', $config);

        return $config;
    }

    /**
     * @depends testInvocationReturnsArray
     */
    public function testReturnedArrayContainsDependencies(array $config)
    {
        $this->assertArrayHasKey('dependencies', $config);
        $this->assertArrayHasKey('templates', $config);
        $this->assertArrayHasKey('paths', $config['templates']);
        $this->assertArrayHasKey('error', $config['templates']['paths']);
        $this->assertArrayHasKey('layout', $config['templates']['paths']);
        $this->assertInternalType('array', $config['dependencies']);
    }
}
