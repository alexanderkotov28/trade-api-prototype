<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts\Requests;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\RequestInterface;

abstract class Request
{
    const BASE_URL = "https://payeer.com/api/trade";

    protected ClientInterface $http_client;

    public function __construct(ClientInterface $http_client)
    {
        $this->http_client = $http_client;
    }

    abstract protected function getPath(): string;

    abstract protected function getMethod(): string;

    abstract protected function getParams(): array;

    abstract protected function buildParams(): array;

    abstract protected function getHeaders(): array;

    public function execute()
    {
        $response = $this->http_client->request($this->getMethod(), $this->getUri(), $this->getOptions());
        $result = json_decode($response->getBody()->getContents());
        return $result;
    }

    private function getUri(): string
    {
        return self::BASE_URL . $this->getPath();
    }

    private function getOptions(): array
    {
        return [
            'json' => $this->buildParams(),
            'headers' => $this->getHeaders()
        ];
    }
}