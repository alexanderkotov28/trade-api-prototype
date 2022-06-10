<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts\Requests;

use AlexanderKotov28\TradeApiPrototype\Response;
use GuzzleHttp\ClientInterface;

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

    public function execute(): Response
    {
        $response = $this->http_client->request($this->getMethod(), $this->getUri(), $this->getOptions());
        return new Response($response->getBody()->getContents());
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