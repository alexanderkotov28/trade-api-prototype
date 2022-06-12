<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\Request as RequestInterface;
use AlexanderKotov28\TradeApiPrototype\Response;
use GuzzleHttp\ClientInterface;

abstract class Request implements RequestInterface
{
    const BASE_URL = "https://payeer.com/api/trade";

    protected ClientInterface $http_client;

    public function __construct(ClientInterface $http_client)
    {
        $this->http_client = $http_client;
    }

    abstract public function getPath(): string;

    abstract public function getMethod(): string;

    abstract public function getParams(): array;

    abstract public function buildParams(): array;

    abstract public function getHeaders(): array;

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