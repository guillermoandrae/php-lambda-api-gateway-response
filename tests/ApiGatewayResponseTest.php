<?php

namespace GuillermoandraeTest\Lambda;

use Guillermoandrae\Http\StatusCodes;
use Guillermoandrae\Lambda\Contracts\AbstractApiGatewayResponse;
use PHPUnit\Framework\TestCase;

final class ApiGatewayResponseTest extends TestCase
{
    public function testSetGetStatusCode()
    {
        $response = $this->getMockForAbstractClass(AbstractApiGatewayResponse::class);
        $statusCode = 301;
        $response->setStatusCode($statusCode);
        $this->assertEquals($statusCode, $response->getStatusCode());
    }

    public function testAddGetHeaders()
    {
        $response = $this->getMockForAbstractClass(AbstractApiGatewayResponse::class);
        $defaultHeader = ['Access-Control-Allow-Origin' => '*'];
        $newHeaderName = 'My-Header';
        $newHeaderValue = 'Test';
        $expectedHeaders = array_merge($defaultHeader, [$newHeaderName => $newHeaderValue]);
        $response->addHeader($newHeaderName, $newHeaderValue);
        $this->assertEquals($expectedHeaders, $response->getHeaders());
    }

    public function testSetGetEvent()
    {
        $response = $this->getMockForAbstractClass(AbstractApiGatewayResponse::class);
        $event = ['this', 'is', 'a', 'test'];
        $response->setEvent($event);
        $this->assertEquals($event, $response->getEvent());
    }

    public function testSend()
    {
        $response = $this->getMockForAbstractClass(AbstractApiGatewayResponse::class);
        $output = $response->send();
        $body = json_decode($output['body'], true);
        $this->assertEquals(200, $output['statusCode']);
        $this->assertEquals(3, $body['meta']['count']);
    }

    public function testSendWithoutBody()
    {
        $response = $this->getMockForAbstractClass(
            AbstractApiGatewayResponse::class,
            [],
            '',
            true,
            true,
            true,
            ['handle']
        );
        $response->setStatusCode(StatusCodes::CREATED);
        $output = $response->send();
        $this->assertEquals(StatusCodes::CREATED, $output['statusCode']);
        $this->assertArrayNotHasKey('body', $output);
    }
}
