<?php

namespace AlexanderKotov28\TradeApiPrototype;

use AlexanderKotov28\TradeApiPrototype\Contracts\RequestFactory as RequestFactoryInterface;
use AlexanderKotov28\TradeApiPrototype\Requests\InfoRequest;
use GuzzleHttp\ClientInterface;

class RequestFactory implements RequestFactoryInterface
{
    private ?string $api_id;
    private ?string $api_secret_key;
    private ClientInterface $http_client;

    public function __construct(?string $api_id = null, ?string $api_secret_key = null, ?ClientInterface $http_client = null)
    {
        $this->api_id = $api_id;
        $this->api_secret_key = $api_secret_key;
        $this->http_client = $http_client;
    }

    public function createInfoRequest(): InfoRequest
    {
        return new InfoRequest($this->http_client);
    }
}