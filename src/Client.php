<?php

namespace AlexanderKotov28\TradeApiPrototype;

use AlexanderKotov28\TradeApiPrototype\Contracts\RequestFactory as RequestFactoryInterface;
use AlexanderKotov28\TradeApiPrototype\Requests\AccountRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\InfoRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\MyOrdersRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\OrderCreateRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\OrdersRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\OrderStatusRequest;

class Client
{
    private RequestFactoryInterface $request_factory;

    public function __construct(?string $api_id = null, ?string $api_secret_key = null)
    {
        $this->request_factory = new RequestFactory($api_id, $api_secret_key, new \GuzzleHttp\Client());
    }

    public function info(): InfoRequest
    {
        return $this->request_factory->createInfoRequest();
    }

    public function orders(): OrdersRequest
    {
        return $this->request_factory->createOrdersRequest();
    }

    public function account(): AccountRequest
    {
        return $this->request_factory->createAccountRequest();
    }

    public function orderCreate(): OrderCreateRequest
    {
        return $this->request_factory->createOrderCreateRequest();
    }

    public function orderStatus(): OrderStatusRequest
    {
        return $this->request_factory->createOrderStatusRequest();
    }

    public function myOrders(): MyOrdersRequest
    {
        return $this->request_factory->createMyOrdersRequest();
    }

}
