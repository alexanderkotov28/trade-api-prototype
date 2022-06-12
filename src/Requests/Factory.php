<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\Factory as RequestFactoryInterface;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\InfoRequest as InfoRequestInterface;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\OrdersRequest as OrdersRequestInterface;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\AccountRequest as AccountRequestInterface;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\OrderCreateRequest as OrderCreateRequestInterface;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\OrderStatusRequest as OrderStatusRequestInterface;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\MyOrdersRequest as MyOrdersRequestInterface;
use GuzzleHttp\ClientInterface;

class Factory implements RequestFactoryInterface
{
    private ?string $api_id;
    private ?string $api_secret_key;
    private ClientInterface $http_client;

    public function __construct(ClientInterface $http_client = null, ?string $api_id = null, ?string $api_secret_key = null)
    {
        $this->api_id = $api_id;
        $this->api_secret_key = $api_secret_key;
        $this->http_client = $http_client;
    }

    public function createInfoRequest(): InfoRequestInterface
    {
        return new InfoRequest($this->http_client);
    }

    public function createOrdersRequest(): OrdersRequestInterface
    {
        return new OrdersRequest($this->http_client);
    }

    public function createAccountRequest(): AccountRequestInterface
    {
        return (new AccountRequest($this->http_client))
            ->setApiId($this->api_id)
            ->setApiSecretKey($this->api_secret_key);
    }

    public function createOrderCreateRequest(): OrderCreateRequestInterface
    {
        return (new OrderCreateRequest($this->http_client))
            ->setApiId($this->api_id)
            ->setApiSecretKey($this->api_secret_key);
    }

    public function createOrderStatusRequest(): OrderStatusRequestInterface
    {
        return (new OrderStatusRequest($this->http_client))
            ->setApiId($this->api_id)
            ->setApiSecretKey($this->api_secret_key);
    }

    public function createMyOrdersRequest(): MyOrdersRequestInterface
    {
        return (new MyOrdersRequest($this->http_client))
            ->setApiId($this->api_id)
            ->setApiSecretKey($this->api_secret_key);
    }
}