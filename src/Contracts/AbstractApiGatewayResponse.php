<?php

namespace Guillermoandrae\Lambda\Contracts;

abstract class AbstractApiGatewayResponse implements ApiGatewayResponseInterface
{
    /**
     * The event data from the API Gateway request.
     *
     * @var array
     */
    protected $event;

    /**
     * Successful HTTP status code; returned by default.
     *
     * @var int
     */
    protected $statusCode = 200;

    /**
     * An array of headers to be sent with the response.
     *
     * @var array
     */
    protected $headers = [];

    /**
     * An array of headers to be sent with every response.
     *
     * @var array
     */
    protected $requiredHeaders = [
        'Access-Control-Allow-Origin' => '*',
    ];

    final public function setEvent(array $event): ApiGatewayResponseInterface
    {
        $this->event = $event;
        return $this;
    }

    final public function getEvent(): array
    {
        return $this->event;
    }

    final public function setStatusCode(int $statusCode): ApiGatewayResponseInterface
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    final public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    final public function addHeader(string $name, $value): ApiGatewayResponseInterface
    {
        $this->headers[$name] = $value;
        return $this;
    }

    final public function getHeaders(): array
    {
        return array_merge($this->headers, $this->requiredHeaders);
    }

    final public function send(): array
    {
        return [
            'statusCode' => $this->getStatusCode(),
            'headers' => $this->getHeaders(),
            'body' => json_encode($this->getBody())
        ];
    }

    public function getBody(): array
    {
        $songs = [
            ['artist' => 'Afta-1', 'songTitle' => 'Quest', 'albumTitle' => 'Aftathoughts Vol. 1'],
            ['artist' => 'Eric Lau', 'songTitle' => 'Cloud Burst', 'albumTitle' => 'Quadrivium'],
            ['artist' => 'Dr. Who Dat?', 'songTitle' => 'Braziliant Thought', 'albumTitle' => 'Beat Journey'],
        ];
        return [
            'meta' => [
                'count' => count($songs)
            ],
            'data' => $songs
        ];
    }
}
