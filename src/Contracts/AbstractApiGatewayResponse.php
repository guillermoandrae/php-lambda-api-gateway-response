<?php

namespace Guillermoandrae\Lambda\Contracts;

use Guillermoandrae\Http\StatusCodes;

abstract class AbstractApiGatewayResponse implements ApiGatewayResponseInterface
{
    /**
     * The event data from the API Gateway request.
     *
     * @var array
     */
    protected array $event;

    /**
     * HTTP status code; OK returned by default.
     *
     * @var int
     */
    protected int $statusCode = StatusCodes::OK;

    /**
     * An array of headers to be sent with the response.
     *
     * @var array
     */
    protected array $headers = [];

    /**
     * An array of headers to be sent with every response.
     *
     * @var array
     */
    protected array $requiredHeaders = [
        'Access-Control-Allow-Origin' => '*',
    ];

    /**
     * An array of data that represents the body of the response.
     *
     * @var array
     */
    protected array $body = [];

    final public function setEvent(array $event): static
    {
        $this->event = $event;
        return $this;
    }

    final public function getEvent(): array
    {
        return $this->event;
    }

    final public function setStatusCode(int $statusCode): static
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    final public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    final public function addHeader(string $name, $value): static
    {
        $this->headers[$name] = $value;
        return $this;
    }

    final public function getHeaders(): array
    {
        return array_merge($this->headers, $this->requiredHeaders);
    }

    final public function addBodyMeta(string $name, $value): static
    {
        if (!array_key_exists('meta', $this->body)) {
            $this->body['meta'] = [];
        }
        $this->body['meta'][$name] = $value;
        return $this;
    }

    final public function setBodyData(array $value): static
    {
        $this->body['data'] = $value;
        return $this;
    }

    final public function getBody(): array
    {
        return $this->body;
    }

    final public function send(): array
    {
        $this->handle();
        $response = [
            'statusCode' => $this->getStatusCode(),
            'headers' => $this->getHeaders(),
        ];
        if ($this->body) {
            $response['body'] = json_encode($this->getBody());
        }
        return $response;
    }

    public function handle(): void
    {
        $songs = [
            ['artist' => 'Afta-1', 'songTitle' => 'Quest', 'albumTitle' => 'Aftathoughts Vol. 1'],
            ['artist' => 'Eric Lau', 'songTitle' => 'Cloud Burst', 'albumTitle' => 'Quadrivium'],
            ['artist' => 'Dr. Who Dat?', 'songTitle' => 'Braziliant Thought', 'albumTitle' => 'Beat Journey'],
        ];
        $this->addBodyMeta('count', count($songs));
        $this->setBodyData($songs);
    }
}
