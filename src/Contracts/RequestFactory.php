<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts;

use AlexanderKotov28\TradeApiPrototype\Requests\InfoRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\OrdersRequest;

interface RequestFactory
{
    public function createInfoRequest(): InfoRequest;

    public function createOrdersRequest(): OrdersRequest;
}