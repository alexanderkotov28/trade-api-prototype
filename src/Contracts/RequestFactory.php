<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts;

use AlexanderKotov28\TradeApiPrototype\Requests\AccountRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\InfoRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\MyOrdersRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\OrderCreateRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\OrdersRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\OrderStatusRequest;

interface RequestFactory
{
    public function createInfoRequest(): InfoRequest;

    public function createOrdersRequest(): OrdersRequest;

    public function createAccountRequest(): AccountRequest;

    public function createOrderCreateRequest(): OrderCreateRequest;

    public function createOrderStatusRequest(): OrderStatusRequest;

    public function createMyOrdersRequest(): MyOrdersRequest;
}