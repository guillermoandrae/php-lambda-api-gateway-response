<?php

namespace Guillermoandrae\Lambda\Contracts;

use \Exception;

interface ApiGatewayResponseInterface
{
    /**
     * Registers the request event information with this object.
     *
     * @param array $event The event data from the API Gateway request.
     * @return ApiGatewayResponseInterface An implementation of this class.
     */
    public function setEvent(array $event): ApiGatewayResponseInterface;

    /**
     * Returns the request event information.
     *
     * @return array The event data from the API Gateway request.
     */
    public function getEvent(): array;

    /**
     * Registers the HTTP status code with the object.
     *
     * @param int $statusCode The HTTP status code.
     * @return ApiGatewayResponseInterface An implementation of this class.
     */
    public function setStatusCode(int $statusCode): ApiGatewayResponseInterface;

    /**
     * Returns the HTTP status code.
     *
     * @return int The HTTP status code.
     */
    public function getStatusCode(): int;

    /**
     * Registers a header with the object.
     *
     * @param string $name The header name.
     * @param mixed $value The header value.
     * @return ApiGatewayResponseInterface An implementation of this class.
     */
    public function addHeader(string $name, $value): ApiGatewayResponseInterface;

    /**
     * Returns an array of headers to be sent with the response.
     *
     * @return array The response headers.
     */
    public function getHeaders(): array;

    /**
     * Returns a response to be sent to the API Gateway.
     *
     * @return array The response.
     */
    public function send(): array;

    /**
     * Returns the response body information.
     *
     * @return array The response body.
     */
    public function getBody(): array;
}
