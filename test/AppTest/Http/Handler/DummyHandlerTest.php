<?php
declare(strict_types=1);

namespace App;

use App\Http\Handler\DummyHandler;
use PHPUnit\Framework\TestCase;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
class DummyHandlerTest extends TestCase
{
    public function testResponse(): void
    {
        $dummyHandler = new DummyHandler();

        $response = $dummyHandler->handle(
            $this->prophesize(ServerRequestInterface::class)->reveal()
        );
        $json = (array)json_decode((string) $response->getBody());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertTrue(isset($json['hello-zend-expressive']));
        $this->assertTrue($json['hello-zend-expressive']);
    }
}
