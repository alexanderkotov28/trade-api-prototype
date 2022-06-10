<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts;

use AlexanderKotov28\TradeApiPrototype\Requests\InfoRequest;

interface RequestFactory
{
    public function createInfoRequest(): InfoRequest;
}