<?php

namespace AlexanderKotov28\TradeApiPrototype;

use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\Factory;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\AccountRequest;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\InfoRequest;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\MyOrdersRequest;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\OrderCreateRequest;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\OrdersRequest;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\OrderStatusRequest;

class Client
{
    private Factory $request_factory;

    public function __construct(Factory $request_factory)
    {
        $this->request_factory = $request_factory;
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
